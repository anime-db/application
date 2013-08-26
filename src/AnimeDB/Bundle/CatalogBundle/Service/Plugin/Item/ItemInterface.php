<?php
/**
 * AnimeDB package
 *
 * @package   AnimeDB
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDB\Bundle\CatalogBundle\Service\Plugin\Item;

use AnimeDB\Bundle\CatalogBundle\Service\Plugin\PluginInterface;
use AnimeDB\Bundle\CatalogBundle\Service\Plugin\CustomMenu;

/**
 * Plugin item interface
 * 
 * @package AnimeDB\Bundle\CatalogBundle\Service\Plugin\Item
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
interface ImportInterface extends PluginInterface, CustomMenu
{
}