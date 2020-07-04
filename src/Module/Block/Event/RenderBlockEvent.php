<?php

namespace App\Module\Block\Event;

final class RenderBlockEvent
{
    private $block;

    public function __construct(
        \App\Module\Block\BlockInterface $block
    )
    {
        $this->block = $block;
    }

    public function setBlock(\App\Module\Block\BlockInterface $block)
    {
        $this->block = $block;
    }

    public function getBlock()
    {
        return $this->block;
    }
}