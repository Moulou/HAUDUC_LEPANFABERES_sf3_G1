<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
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
        /*$antispam = $this->get('antispam'); #récupération d'une class#
        #dump($antispam->isSpam('RRRRRRRRRRRRRRRRRRRRRRRRRRRR'));die;

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
        ]);*/

        $em = $this->getDoctrine()->getManager();
        $articleRepository = $em->getRepository('AppBundle:Article\Article');

        $article = new Article();
        $article
                ->setTitle('Titre 2.0')
                ->setContent('blabla')
                ->setTag('THE BIG TAG')
                ->setCreatedAt(new \DateTime())
            ;

        $em->persist($article);#met en mémoire l'article
        $em->flush();#envois l'article dans la base

        return new Response('Article created');


    }


}
