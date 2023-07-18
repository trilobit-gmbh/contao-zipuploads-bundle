<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('zipuploads_legend', 'config_legend')
    ->addField('zipUploadedFiles', 'zipuploads_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_form')
;

$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'zipUploadedFiles';
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'zipAutomaticallyDeleteZipfiles';
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['zipUploadedFiles'] = 'zipFilename,zipDoNotOverwrite,zipDestinationFolder,zipDeleteUploadsAfterZip,zipAutomaticallyDeleteZipfiles';
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['zipAutomaticallyDeleteZipfiles'] = 'zipPeriodZipfilesMaintenance';

$GLOBALS['TL_DCA']['tl_form']['fields']['zipUploadedFiles'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipUploadedFiles'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_form']['fields']['zipFilename'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipFilename'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_form']['fields']['zipDoNotOverwrite'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipDoNotOverwrite'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 cbx m12'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_form']['fields']['zipDestinationFolder'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipDestinationFolder'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['mandatory' => true, 'fieldType' => 'radio', 'tl_class' => 'clr'],
    'sql' => 'binary(16) NULL',
];

$GLOBALS['TL_DCA']['tl_form']['fields']['zipDeleteUploadsAfterZip'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipDeleteUploadsAfterZip'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "char(1) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_form']['fields']['zipAutomaticallyDeleteZipfiles'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipAutomaticallyDeleteZipfiles'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['submitOnChange' => true, 'tl_class' => 'clr w50'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_form']['fields']['zipPeriodZipfilesMaintenance'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_form']['zipPeriodZipfilesMaintenance'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];
