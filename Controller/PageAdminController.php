<?php

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Controller;

use Sonata\PageBundle\Controller\PageAdminController as BasePageAdminController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page Admin Controller.
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class PageAdminController extends BasePageAdminController
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function treeAction(Request $request = null)
    {
        $this->admin->checkAccess('tree');

        $sites = $this->get('sonata.page.manager.site')->findBy(array());
        $pageManager = $this->get('sonata.page.manager.page');

        $currentSite = null;
        $siteId = $request->get('site');
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

        $showAllPages = $this->get('security.context')->isGranted('ROLE_SUPER_ADMIN');

        if ($currentSite) {
            $pages = $pageManager->loadPages($currentSite, $showAllPages);
        } else {
            $pages = array();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('tree'), array(
            'action'      => 'tree',
            'sites'       => $sites,
            'currentSite' => $currentSite,
            'pages'       => $pages,
            'form'        => $formView,
            'csrf_token'  => $this->getCsrfToken('sonata.batch'),
        ));
    }
}
