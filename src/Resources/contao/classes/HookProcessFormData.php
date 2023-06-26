<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ZipuploadsBundle;

use Contao\Config;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\Database;
use Contao\Date;
use Contao\Dbafs;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\System;
use Contao\ZipWriter;

/**
 * Class HookProcessFormData.
 */
class HookProcessFormData
{
    /**
     * @param $arrSubmitted
     * @param $arrData
     * @param $arrFiles
     * @param $arrLabels
     * @param $that
     *
     * @throws \Exception
     */
    public function zipUploadedFiles(&$arrSubmitted, $arrData, $arrFiles, $arrLabels, $that)
    {
        echo '<pre>';

        if (empty($arrData['zipUploadedFiles'])) {
            return false;
        }

        $time = time();

        $rootDir = System::getContainer()->getParameter('kernel.project_dir');
        $strExtension = 'zip';
        $version = (method_exists(ContaoCoreBundle::class, 'getVersion') ? ContaoCoreBundle::getVersion() : VERSION);

        $fields = Database::getInstance()
            ->prepare("SELECT name FROM tl_form_field WHERE pid=? AND type=? AND invisible='' ORDER BY sorting")
            ->execute($arrData['id'], 'fineUploader')
        ;

        while ($fields->next()) {
            foreach ($arrSubmitted[$fields->name] as $key => $value) {
                $upload = Dbafs::addResource($value);

                $arrFiles[$fields->name.'_'.$key] = [
                    'name' => $upload->name,
                    'type' => '',
                    'tmp_name' => $rootDir.'/'.$upload->path,
                    'error' => 0,
                    'size' => filesize($rootDir.'/'.$upload->path),
                    'uploaded' => (version_compare($version, '5.0', '>=')) ? true : 1,
                    'uuid' => StringUtil::binToUuid($upload->uuid),
                ];
            }
        }

        // Prepare simple tokens
        $arrTokens = [
            'rand' => uniqid('', true),
            'date' => Date::parse(Config::get('dateFormat'), $time),
            'time' => Date::parse(Config::get('timeFormat'), $time),
            'datim' => Date::parse(Config::get('datimFormat'), $time),
        ];

        foreach ($arrSubmitted as $key => $value) {
            if (\is_array($value)) {
                $arrTokens['form_'.$key] = implode(',', $value);
            } else {
                $arrTokens['form_'.$key] = $value;
            }
        }

        // Set zip file name
        if (version_compare($version, '5.0', '>=')) {
            $strFilename = StringUtil::generateAlias(System::getContainer()->get('contao.string.simple_token_parser')->parse(StringUtil::decodeEntities(
                $arrData['zipFilename']
            ), $arrTokens));
        } else {
            $strFilename = StringUtil::generateAlias(
                StringUtil::parseSimpleTokens(
                    StringUtil::decodeEntities(
                        $arrData['zipFilename']
                    ), $arrTokens
                )
            );
        }

        // Set upload folder
        $objUploadFolder = FilesModel::findByUuid($arrData['zipDestinationFolder']);

        // The upload folder could not be found
        if (null === $objUploadFolder) {
            throw new \Exception('Invalid upload folder ID '.$arrData['zipDestinationFolder']);
        }

        $strUploadFolder = $objUploadFolder->path;

        // Do not overwrite existing files
        if (!empty($arrData['zipDoNotOverwrite']) && file_exists($rootDir.'/'.$strUploadFolder.'/'.$strFilename.'.'.$strExtension)) {
            $offset = 1;

            $arrTmpAll = scan($rootDir.'/'.$strUploadFolder);
            $arrTmpFiles = preg_grep('/^'.preg_quote($strFilename, '/').'.*\.'.preg_quote($strExtension, '/').'/', $arrTmpAll);

            foreach ($arrTmpFiles as $strTmpFile) {
                if (preg_match('/__[0-9]+\.'.preg_quote($strExtension, '/').'$/', $strTmpFile)) {
                    $strTmpFile = str_replace('.'.$strExtension, '', $strTmpFile);
                    $intValue = (int) substr($strFilename, (strrpos($strTmpFile, '_') + 1));

                    $offset = max($offset, $intValue);
                }
            }

            $strFilename = str_replace($strFilename, $strFilename.'__'.++$offset, $strFilename);
        }

        // Set zip
        $objZip = new ZipWriter($strUploadFolder.'/'.$strFilename.'.'.$strExtension);

        foreach ($arrFiles as $value) {
            if (\is_array($value)
                && isset($value['uploaded']) && $value['uploaded']
                && isset($value['error']) && 0 === $value['error']
                && isset($value['size']) && 0 < $value['size']
                && isset($value['tmp_name']) && file_exists($value['tmp_name'])
            ) {
                $value['tmp_name'] = str_replace($rootDir.'/', '', $value['tmp_name']);
                $objZip->addFile($value['tmp_name'], $value['name']);
            }
        }

        $objZip->close();

        // Append new field with zip-file data
        $arrSubmitted['autogeneretedZippedUploads'] = $strUploadFolder.'/'.$strFilename.'.'.$strExtension;

        return false;
    }
}
