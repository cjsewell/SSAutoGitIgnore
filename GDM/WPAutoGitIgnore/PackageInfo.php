<?php

namespace GDM\WPAutoGitIgnore;

use Composer\Composer;
use Composer\Package\Package;

class PackageInfo
{

    /**
     * Path to current projects root directory
     * @var string
     */
    protected $baseDir = '';

    /**
     *
     * @var Composer
     */
    protected $composer = '';

    /**
     *
     * @var Composer\Repository\RepositoryManager
     */
    protected $repoManager = '';

    /**
     *
     * @var Composer\Installer\InstallationManager
     */
    protected $installManager = '';

    /**
     * A package must be one of these types to be included
     *
     * @var array
     */
    protected $requiredTypes = ['wordpress-plugin', 'wordpress-theme'];

    public function __construct(Composer $composer)
    {
        $this->composer       = $composer;
        $this->repoManager    = $this->composer->getRepositoryManager();
        $this->installManager = $composer->getInstallationManager();
        $this->baseDir        = $this->NormalizePath(getcwd());
    }

    public function findAll()
    {
        $packages = [];

        foreach ($this->repoManager->getLocalRepository()->getPackages() as $package) {
            /* @var $package Package */
            if (! isset($packages[$package->getName()]) || ! is_object($packages[$package->getName()]) || version_compare($packages[$package->getName()]->getVersion(), $package->getVersion(), '<')
            ) {
                if (in_array($package->getType(), $this->requiredTypes, true)) {
                    $packagePath                           = $this->NormalizePath($this->installManager->getInstallPath($package));
                    $packages[$package->getName()]['info'] = $package;
                    $packages[$package->getName()]['path'] = $packagePath;
                }
            }
        }

        return $packages;
    }

    protected function NormalizePath($path)
    {
        $search  = ['\\', '\\\\', '//', $this->baseDir];
        $replace = ['/', '/', '/', ''];

        return trim(str_replace($search, $replace, $path), '/');
    }
}
