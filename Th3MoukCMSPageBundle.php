<?php

namespace Th3Mouk\CMSPageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Th3MoukCMSPageBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataPageBundle';
    }
}
