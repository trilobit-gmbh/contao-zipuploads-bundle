<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ZipuploadsBundle\Cron;

use Contao\Config;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\CoreBundle\ServiceAnnotation\CronJob;
use Contao\Date;
use Contao\FilesModel;
use Contao\System;
use DirectoryIterator;
use Psr\Log\LogLevel;

/**
 * @CronJob("minutely")
 */
class Cron
{
    public function __construct(ContaoFramework $framework)
    {
        $framework->initialize();
    }

    /**
     * @throws \Exception
     */
    public function __invoke(): void
    {
        $container = System::getContainer();
        $rootDir = $container->getParameter('kernel.project_dir');
        $logger = $container->get('monolog.logger.contao');
        $connection = $container->get('database_connection');

        $result = $connection
            ->executeQuery("SELECT zipFilename, zipDestinationFolder, zipPeriodZipfilesMaintenance FROM tl_form WHERE zipUploadedFiles!='' AND zipAutomaticallyDeleteZipfiles!=''")
            ->fetchAllAssociative()
        ;

        $search = ['/[^\pN\pL \.\&\/_-]+/u', '/[ \.\&\/-]+/'];
        $replace = ['', '-'];

        $tokens = [
            '&#35;&#35;rand&#35;&#35;' => '([a-z0-9\-_\.]{'.\strlen(uniqid('', true)).'})',
            '&#35;&#35;date&#35;&#35;' => Date::getRegexp(preg_replace($search, $replace, Config::get('dateFormat'))),
            '&#35;&#35;time&#35;&#35;' => Date::getRegexp(preg_replace($search, $replace, Config::get('timeFormat'))),
            '&#35;&#35;datim&#35;&#35;' => Date::getRegexp(preg_replace($search, $replace, Config::get('datimFormat'))),
        ];

        foreach ($result as $value) {
            $dir = FilesModel::findByUuid($value['zipDestinationFolder']);

            if (empty($dir)) {
                continue;
            }

            $dir = $rootDir.'/'.$dir->path;

            $timeout = strtotime($value['zipPeriodZipfilesMaintenance']);
            $regex = '^'.$value['zipFilename'].'\.zip$';

            foreach ($tokens as $tokenKey => $tokenValue) {
                $regex = str_replace($tokenKey, $tokenValue, $regex);
            }

            $regex = \Safe\preg_replace('/&#35;&#35;form_.*?&#35;&#35;/', '(.*?)', $regex);

            if (is_dir($dir)) {
                $files = new DirectoryIterator($dir);

                foreach ($files as $file) {
                    if ($file->isDot()
                        || !$file->isFile()
                        || 'zip' !== pathinfo((string) $file->current(), \PATHINFO_EXTENSION)
                        || !preg_match('/'.$regex.'$/iJ', (string) $file->current())
                    ) {
                        continue;
                    }

                    if ($file->getCTime() <= $timeout) {
                        $logger->log(
                            LogLevel::INFO,
                            'Unlink file \''.$file->getFilename().'\' ['.Date::parse('Y/m/d H:i', $file->getCTime()).']',
                            ['contao' => new ContaoContext(__METHOD__, 'CRON')]
                        );

                        unlink($file->getRealPath());
                    }
                }
            } else {
                $logger->log(
                    LogLevel::ERROR,
                    'Directory \''.$dir.'\' not found',
                    ['contao' => new ContaoContext(__METHOD__, 'CRON')]
                );
            }
        }
    }
}
