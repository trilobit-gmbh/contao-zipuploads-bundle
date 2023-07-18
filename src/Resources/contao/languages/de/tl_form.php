<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
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
$GLOBALS['TL_LANG']['tl_form']['zipDeleteUploadsAfterZip'][0] = 'Alle Uploads nach zippen löschen';
$GLOBALS['TL_LANG']['tl_form']['zipDeleteUploadsAfterZip'][1] = 'Alle Uploads, die als ZIP zusammengefasst sind, automatisch löschen.';
$GLOBALS['TL_LANG']['tl_form']['zipAutomaticallyDeleteZipfiles'][0] = 'ZIP-Dateien automatisch löschen';
$GLOBALS['TL_LANG']['tl_form']['zipAutomaticallyDeleteZipfiles'][1] = 'Generierte ZIP-Dateien automatisch nach einem definierten Zeitraum löschen.';
$GLOBALS['TL_LANG']['tl_form']['zipPeriodZipfilesMaintenance'][0] = 'Lösch-Zeitraum';
$GLOBALS['TL_LANG']['tl_form']['zipPeriodZipfilesMaintenance'][1] = 'Zeitraum, nachdem die generierten ZIP-Dateien automatisch gelöscht werden. Bspl.: "-1 day" (Dateien älter 1 Tag löschen). Format: vgl https://www.php.net/manual/de/function.strtotime.php';
