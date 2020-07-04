<?php


namespace App\Module\Main\Block\Page;


use App\Module\Block\AbstractBlock;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainPage extends AbstractBlock
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([
        ]);
    }

}