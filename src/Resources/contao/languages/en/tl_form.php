<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

// Legend
$GLOBALS['TL_LANG']['tl_form']['zipuploads_legend'] = 'File-Upload settings';

// Fields
$GLOBALS['TL_LANG']['tl_form']['zipUploadedFiles'][0] = 'Summarize uploads in a ZIP';
$GLOBALS['TL_LANG']['tl_form']['zipUploadedFiles'][1] = 'All uploads of the form as a ZIP summarize. The ZIP is provided via the simple token ##form_autogeneretedZippedUploads##.';
$GLOBALS['TL_LANG']['tl_form']['zipDestinationFolder'][0] = 'Target folder';
$GLOBALS['TL_LANG']['tl_form']['zipDestinationFolder'][1] = 'Please select the target folder from the files directory.';
$GLOBALS['TL_LANG']['tl_form']['zipDoNotOverwrite'][0] = 'Preserve existing files';
$GLOBALS['TL_LANG']['tl_form']['zipDoNotOverwrite'][1] = 'Add a numeric suffix to the new file if the file name already exists.';

$GLOBALS['TL_LANG']['tl_form']['zipFilename'][0] = 'ZIP filename';
$GLOBALS['TL_LANG']['tl_form']['zipFilename'][1] = 'Please enter the file name of the ZIP (without the file extension .zip). You can use simple tokens (##rand##, ##date##, ##time##, ##datim## and all form fields above ##form _*##).';
