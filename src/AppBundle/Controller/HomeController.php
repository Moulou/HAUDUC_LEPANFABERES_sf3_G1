<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $antispam = $this->get('antispam'); #récupération d'une class#
        dump($antispam->isSpam('RRRRRRRRRRRRRR'));die;

        $name = 'Symfony 3';

        $tutorials = [
            [
                'id'=> 2,
                'name'=> 'Symfony 2'
            ],
            [
                'id' => 5,
                'name' => 'Laravel'
            ],
            [
                'id' => 9,
                'name' => 'Wordpress'
            ],

        ];
        return $this->render('AppBundle:Home:index.html.twig', [
            'name'      => $name,
            'tutorials' => $tutorials,
        ]);
    }


}
