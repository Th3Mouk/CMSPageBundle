<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Controller;

use Sonata\PageBundle\Controller\PageAdminController as BasePageAdminController;

/**
 * Page Admin Controller
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class PageAdminController extends BasePageAdminController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function treeAction()
    {
        $sites = $this->get('sonata.page.manager.site')->findBy(array());
        $pageManager = $this->get('sonata.page.manager.page');

        $currentSite = null;
        $siteId = $this->getRequest()->get('site');
        foreach ($sites as $site) {
            if ($siteId && $site->getId() == $siteId) {
                $currentSite = $site;
            } elseif (!$siteId && $site->getIsDefault()) {
                $currentSite = $site;
            }
        }
        if (!$currentSite && count($sites) == 1) {
            $currentSite = $sites[0];
        }

        if ($currentSite) {
            if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
                $pages = $pageManager->loadPagesAdmin($currentSite);
            } else {
                $pages = $pageManager->loadPages($currentSite);
            }
        } else {
            $pages = array();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('SonataPageBundle:PageAdmin:tree.html.twig', array(
            'action'      => 'tree',
            'sites'       => $sites,
            'currentSite' => $currentSite,
            'pages'       => $pages,
            'form'        => $formView,
            'csrf_token'  => $this->getCsrfToken('sonata.batch'),
        ));
    }
}