<?php
namespace App\Module\Block\Twig\Extension;

use Twig\Extension\AbstractExtension;

class BlockExtension extends AbstractExtension
{
    protected $blockService;

    public function __construct(
        \App\Module\Block\Service\BlockService $blockService
    )
    {
        $this->blockService = $blockService;
    }

    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('renderBlock', [$this, 'renderBlock'],[
                'is_safe' => array('html')
                //'needs_environment' => true,
                //'needs_context' => true,
            ])
        ];
    }

    public function renderBlock(string $block, array $options = [])
    {
        return $this->blockService->renderBlock($block, $options);
    }
}