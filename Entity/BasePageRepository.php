<?php

/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 30/01/15
 * Time: 15:47.
 */
namespace Th3Mouk\CMSPageBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BasePageRepository extends EntityRepository
{
    public function pagesToHide()
    {
        $query = $this->createQueryBuilder('p')
            ->update('ApplicationTh3MoukCMSPageBundle:Page', 'p')
            ->set('p.showRouteAdmin', '0')
            ->where('p.routeName LIKE \'sonata_%\'')
            ->orwhere('p.routeName LIKE \'fos_%\'')
            ->orwhere('p.routeName LIKE \'liip_%\'');

        $home = $query->expr()->andX('p.routeName LIKE \'app_%\'', 'p.routeName NOT LIKE \'app_home%\'');

        $query
            ->orWhere($home);

        $query->getQuery()->execute();
    }
}
