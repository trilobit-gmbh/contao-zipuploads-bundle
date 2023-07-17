<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Trilobit\ZipuploadsBundle\Cron\Cron;
use Trilobit\ZipuploadsBundle\HookProcessFormData;

/*
 * Register hook
 */
$GLOBALS['TL_HOOKS']['processFormData'][] = [HookProcessFormData::class, 'zipUploadedFiles'];
$GLOBALS['TL_CRON']['minutely'][] = [Cron::class, '__invoke'];
