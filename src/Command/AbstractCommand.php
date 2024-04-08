<?php

/*
 * This file is part of CacheTool.
 *
 * (c) Samuel Gordalina <samuel.gordalina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CacheTool\Command;

use CacheTool\CacheTool;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractCommand extends Command
{
    protected ?ContainerInterface $container = null;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function getCacheTool(): CacheTool
    {
        return $this->container->get('cachetool');
    }

    protected function ensureExtensionLoaded(string $extension): void
    {
        if (!$this->getCacheTool()->extension_loaded($extension)) {
            throw new \Exception("Extension `{$extension}` is not loaded");
        }
    }
}
