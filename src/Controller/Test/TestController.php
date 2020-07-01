<?php


namespace App\Controller\Test;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route ("/ing", name="ing")
     */
    public function ing(){
        $d = new Response();
        $d->setContent('LLLLLL');
        return $d;
    }

}