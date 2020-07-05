<?php


namespace App\Module\Test\Block\TwigExtension;


class TestTwigExtension  extends \Twig\Extension\AbstractExtension
{
    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('calcArea', [ $this,'calculateArea']),
        ];
    }

    public function calculateArea(int $width, int $length) :int
    {
        return $width * $length;
    }
}