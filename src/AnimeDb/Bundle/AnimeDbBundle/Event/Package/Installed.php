<?php
/**
 * AnimeDb package
 *
 * @package   AnimeDb
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\AnimeDbBundle\Event\Package;

use Symfony\Component\EventDispatcher\Event;
use Composer\Package\PackageInterface;

/**
 * Event thrown when the package is installed
 *
 * @package AnimeDb\Bundle\AnimeDbBundle\Event\Package
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Installed extends Event
{
    /**
     * Package
     *
     * @var \Composer\Package\PackageInterface
     */
    protected $package;

    /**
     * Construct
     *
     * @param \Composer\Package\PackageInterface $package
     */
    public function __construct($package)
    {
        $this->package = $package;
    }

    /**
     * Get package
     *
     * @return \Composer\Package\PackageInterface
     */
    public function getPackage()
    {
        return $this->package;
    }
}