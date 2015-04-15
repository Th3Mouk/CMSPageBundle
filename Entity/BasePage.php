<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Entity;

use Sonata\PageBundle\Entity\BasePage as Page;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends ).
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
abstract class BasePage extends Page
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $showRouteAdmin = true;

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set showRouteAdmin.
     *
     * @param bool $showRouteAdmin
     *
     * @return Page
     */
    public function setShowRouteAdmin($showRouteAdmin)
    {
        $this->showRouteAdmin = $showRouteAdmin;

        return $this;
    }

    /**
     * Get showRouteAdmin.
     *
     * @return bool
     */
    public function getShowRouteAdmin()
    {
        return $this->showRouteAdmin;
    }
}
