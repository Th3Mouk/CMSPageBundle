<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Entity;

use Sonata\PageBundle\Entity\PageManager as BasePageManager;
use Sonata\PageBundle\Model\SiteInterface;

/**
 * This class manages PageInterface persistency with the Doctrine ORM.
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class PageManager extends BasePageManager
{
    /**
     * {@inheritdoc}
     */
    public function loadPages(SiteInterface $site, $showAllPages = false)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from($this->getClass(), 'p', 'p.id')
            ->andwhere('p.site = :site')
            ->addOrderBy('p.position', 'ASC')
            ->setParameter('site', $site->getId());

        if (!$showAllPages) {
            $qb->andWhere('p.showRouteAdmin = 1');
        }

        $pages = $qb->getQuery()->getResult();

        foreach ($pages as $page) {
            $parent = $page->getParent();

            $page->disableChildrenLazyLoading();
            if (!$parent) {
                continue;
            }

            $pages[$parent->getId()]->disableChildrenLazyLoading();
            $pages[$parent->getId()]->addChildren($page);
        }

        return $pages;
    }
}
