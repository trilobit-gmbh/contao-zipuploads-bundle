<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-zipuploads-bundle
 */

// Legend
$GLOBALS['TL_LANG']['tl_form']['zipuploads_legend'] = 'Datei-Upload-Einstellungen';

// Fields
$GLOBALS['TL_LANG']['tl_form']['zipUploadedFiles'][0] = 'Uploads in einem ZIP zusammenfassen';
$GLOBALS['TL_LANG']['tl_form']['zipUploadedFiles'][1] = 'Alle Uploads des Formular als ZIP zusammenfassen. Das ZIP wird über den Simple-Token ##form_autogeneretedZippedUploads## zur Verfügung gestellt.';
$GLOBALS['TL_LANG']['tl_form']['zipDestinationFolder'][0] = 'Zielverzeichnis';
$GLOBALS['TL_LANG']['tl_form']['zipDestinationFolder'][1] = 'Bitte wählen Sie das Zielverzeichnis aus der Dateiübersicht.';
$GLOBALS['TL_LANG']['tl_form']['zipDoNotOverwrite'][0] = 'Bestehende Dateien erhalten';
$GLOBALS['TL_LANG']['tl_form']['zipDoNotOverwrite'][1] = 'Der neuen Datei ein numerisches Suffix hinzufügen, wenn der Dateiname bereits existiert.';

$GLOBALS['TL_LANG']['tl_form']['zipFilename'][0] = 'Dateiname des ZIP';
$GLOBALS['TL_LANG']['tl_form']['zipFilename'][1] = 'Bitte geben Sie den Dateinamen des ZIP an (ohne die Dateiendung .zip). Sie können Simple-Tokens verwenden (##rand##, ##date##, ##time##, ##datim## sowie alle Formularfelder über ##form_*##).';
