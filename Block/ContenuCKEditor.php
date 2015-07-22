<?php

/**
 * Created by PhpStorm.
 * User: Jeremy.
 */
namespace Th3Mouk\CMSPageBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

class ContenuCKEditor extends BaseBlockService
{
    /**
     * @param FormMapper     $form
     * @param BlockInterface $block
     */
    public function buildEditForm(FormMapper $form, BlockInterface $block)
    {
        $form->add('settings', 'sonata_type_immutable_array', array(
            'keys' => array(
                array('contenu', 'ckeditor', array('required' => false)),
            ),
        ));
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();

        return $this->renderResponse($blockContext->getTemplate(), array(
            'block' => $blockContext->getBlock(),
            'settings' => $settings,
        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'contenu' => null,
            'template' => 'Th3MoukCMSPageBundle:Block:contenu_ckeditor.html.twig',
        ));
    }
}
