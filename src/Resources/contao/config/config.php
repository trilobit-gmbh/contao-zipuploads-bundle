<?php

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 * @link       http://github.com/trilobit-gmbh/contao-zipuploads-bundle
 */

use Trilobit\ZipuploadsBundle\HookProcessFormData;

/*
 * Register hook
 */
$GLOBALS['TL_HOOKS']['processFormData'][] = [HookProcessFormData::class, 'zipUploadedFiles'];
