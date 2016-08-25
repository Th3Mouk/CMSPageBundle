<?php

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Migration;

use Sonata\PageBundle\Entity\BlockManager;

class BlocksMigration
{
    /**
     * @var BlockManager
     */
    private $blockManager;

    /**
     * BlocksMigration constructor.
     *
     * @param BlockManager $blockManager
     */
    public function __construct(BlockManager $blockManager)
    {
        $this->blockManager = $blockManager;
    }

    /**
     * Function of migration of included blocks.
     */
    public function migrateCkeditorBlocks()
    {
        $legacyBlocks = $this->getLegacyCkeditorBlocks();

        foreach ($legacyBlocks as $legacyBlock) {
            $legacyBlock->setType('cms.block.ckeditor');

            $settings = $legacyBlock->getSettings();

            if (isset($settings['contenu'])) {
                $settings['content'] = $settings['contenu'];
                unset($settings['contenu']);
            }

            $legacyBlock->setSettings($settings);

            $this->blockManager->save($legacyBlock);
        }
    }

    /**
     * @return BlockManager
     */
    public function getBlockManager()
    {
        return $this->blockManager;
    }

    /**
     * @param BlockManager $blockManager
     */
    public function setBlockManager($blockManager)
    {
        $this->blockManager = $blockManager;
    }

    /**
     * Return all ckeditor legacy blocks.
     *
     * @return array
     */
    protected function getLegacyCkeditorBlocks()
    {
        return $this->blockManager->findBy(array(
            'type' => 'cms.block.contenu.ckeditor',
        ));
    }
}
