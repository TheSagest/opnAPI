<?php


namespace App\Module\Test\Block;


use App\Module\Block\AbstractBlock;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Test extends AbstractBlock
{
    private $content;



    public function getContent(){

        return 'Test';


    }



}