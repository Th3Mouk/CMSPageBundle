CMS Page Bundle
===============

Bundle extending [SonataPageBundle](https://github.com/sonata-project/SonataPageBundle) in order to simplify the use by developers and future users, trying to not alter the original flexibility, and to give them new basic tools and views.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e11f072f-d128-459c-8100-e50bf565e99a/mini.png)](https://insight.sensiolabs.com/projects/e11f072f-d128-459c-8100-e50bf565e99a) [![Latest Stable Version](https://poser.pugx.org/th3mouk/cms-page-bundle/v/stable.svg)](https://packagist.org/packages/th3mouk/cms-page-bundle) [![Total Downloads](https://poser.pugx.org/th3mouk/cms-page-bundle/downloads.svg)](https://packagist.org/packages/th3mouk/cms-page-bundle) [![Build Status](https://travis-ci.org/Th3Mouk/CMSPageBundle.svg?branch=master)](https://travis-ci.org/Th3Mouk/CMSPageBundle) [![Latest Unstable Version](https://poser.pugx.org/th3mouk/cms-page-bundle/v/unstable.svg)](https://packagist.org/packages/th3mouk/cms-page-bundle) [![License](https://poser.pugx.org/th3mouk/cms-page-bundle/license.svg)](https://packagist.org/packages/th3mouk/cms-page-bundle)

This bundle is part of the preconfigured CMS based on Symfony and Sonata : [CMSStarter](https://github.com/Th3Mouk/CMSStarter) | [CMSCoreBundle](https://github.com/Th3Mouk/CMSCoreBundle)

## SonataPageBundle

The use of this bundle require understanding of the [SonataPageBundle](https://sonata-project.org/bundles/page/master/doc/index.html).

## Installation

### Composer

```sh
composer require th3mouk/cms-page-bundle ^2.0
```

### SonataPageBundle

Install the original [SonataPageBundle](https://sonata-project.org/bundles/page/master/doc/index.html).

### Easy extends

```sh
app/console sonata:easy-extends:generate Th3MoukCMSPageBundle
```

### Update Kernel

```php
# app/AppKernel.php
...
new Th3Mouk\CMSPageBundle\Th3MoukCMSPageBundle(),
new Application\Th3Mouk\CMSPageBundle\ApplicationTh3MoukCMSPageBundle(),
...
```

### Configuration

Create the following files:

```yaml
# app/config/bundles/override.yml
parameters:
    #Overload PageAdmin
    sonata.page.admin.page.class: Th3Mouk\CMSPageBundle\Admin\PageAdmin
    #Overload PageManager
    sonata.page.manager.page.class: Th3Mouk\CMSPageBundle\Entity\PageManager
    #Overload Transformer otherwise additional attributes will be non-serialized
    sonata.page.transformer.class: Th3Mouk\CMSPageBundle\Entity\Transformer
    #Overload PageAdminController
    sonata.page.admin.page.controller: Th3MoukCMSPageBundle:PageAdmin
```

```yaml
# app/config/sonata/sonata_page.yml
sonata_page:
    class:
        page:     Application\Th3Mouk\CMSPageBundle\Entity\Page
        snapshot: Application\Th3Mouk\CMSPageBundle\Entity\Snapshot
        block:    Application\Th3Mouk\CMSPageBundle\Entity\Block
        site:     Application\Th3Mouk\CMSPageBundle\Entity\Site
```
Include them:

```yaml
# app/config/config.yml
imports:
    # Sonata Page Bundle
    - { resource: sonata/sonata_page.yml }

    # Override Vendors Parameters
    - { resource: bundles/override.yml }
```

## Please

Feel free to improve all of this work, project or bundles.
