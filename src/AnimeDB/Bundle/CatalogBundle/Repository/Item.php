<?php
/**
 * AnimeDB package
 *
 * @package   AnimeDB
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDB\Bundle\CatalogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AnimeDB\Bundle\CatalogBundle\Entity\Item as ItemEntity;

/**
 * Item repository
 *
 * @package AnimeDB\Bundle\CatalogBundle\Repository
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Item extends EntityRepository
{
    /**
     * Get count items
     *
     * @return integer
     */
    public function count()
    {
        return $this->getEntityManager()->createQuery('
            SELECT
                COUNT(i)
            FROM
                AnimeDBCatalogBundle:Item i
        ')->getSingleScalarResult();
    }

    /**
     * Get items list
     *
     * @param integer|null $limit
     * @param integer|null $offset
     *
     * @return array [\AnimeDB\Bundle\CatalogBundle\Entity\Item]
     */
    public function getList($limit = 0, $offset = 0)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT
                i
            FROM
                AnimeDBCatalogBundle:Item i
            ORDER BY
                i.id DESC
        ');

        if ($limit) {
            $query
                ->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $query->getResult();
    }

    /**
     * Find duplicate
     *
     * @param \AnimeDB\Bundle\CatalogBundle\Entity\Item $item
     *
     * @return array
     */
    public function findDuplicate(ItemEntity $item)
    {
        // get all names
        $names = [$item->getName()];
        foreach ($item->getNames() as $name) {
            $names[] = $name->getName();
        }

        // find from item main name
        $duplicate = $this->getEntityManager()->createQuery('
            SELECT
                i
            FROM
                AnimeDBCatalogBundle:Item i
            WHERE
                i.name IN (:names)
        ')
            ->setParameter(':names', $names)
            ->getResult();

        // find frim item other names
        $item_names = $this->getEntityManager()->createQuery('
            SELECT
                n
            FROM
                AnimeDBCatalogBundle:Name n
            WHERE
                n.name IN (:names)
        ')
            ->setParameter(':names', $names)
            ->getResult();

        foreach ($item_names as $item_name) {
            foreach ($duplicate as $item) {
                if ($item !== $item_name->getItem()) {
                    $duplicate[] = $item_name->getItem();
                }
            }
        }

        return $duplicate;
    }
}