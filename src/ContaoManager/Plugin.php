<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ZipuploadsBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Trilobit\ZipuploadsBundle\TrilobitZipuploadsBundle;

/**
 * Plugin for the Contao Manager.
 *
 * @author trilobit GmbH <https://github.com/trilobit-gmbh>
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritDoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(TrilobitZipuploadsBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    \Terminal42\FineUploaderBundle\Terminal42FineUploaderBundle::class,
                ]),
        ];
    }
}
