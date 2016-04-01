<?php
namespace AppBundle\Controller\Article;

use AppBundle\Entity\Article\Article;
use AppBundle\Form\Article\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{


	/**
	 * @Route("/{id}", requirements={"id" = "\d+"}, name="article_show")
	 *
	 * @param $id
	 *
	 * @return Response
	 */
	public function showAction($id, Request $request)
	{
		$tag= $request->query->get('tag');
		#faire la condition pour afficher le tag de l'article

		$em = $this->getDoctrine()->getManager();
		$articleRepository = $em->getRepository('AppBundle:Article\Article');

		$articles = $articleRepository->findBy([
			'id' => $id
		]);

		return $this->render('AppBundle:Article:show.html.twig', [
			'articles' => $articles,
		]);

	}

	/**
	 * @Route("/list",name="article_list")
	 */
	public function listAction()
	{
		$em = $this->getDoctrine()->getManager();
		$articleRepository = $em->getRepository('AppBundle:Article\Article');

		$author = 'moi';

		$articles = $articleRepository->findBy([
			'author' => $author
		]);


		return $this->redirectToRoute('article_list');
	}


	/**
	 * @Route("/new",name="article_new")
	 */
	public function newAction(Request $request)
	{

		/*$article = new Article();
		$article
				->setTitle('Titre 2.0')
				->setContent('blabla')
				->setTag('THE BIG TAG')
				->setAuthor('moi')
				->setCreatedAt(new \DateTime())
			;*/

		$form = $this->createForm(ArticleType::class);

		$form->handleRequest($request);

		if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();

		$em->persist($form->getData());#met en mémoire l'article
		$em->flush();#envois l'article dans la base

			return $this->redirectToRoute('/');

	}

		return $this->render('AppBundle:Article:new.html.twig',[
			'form' => $form->createView()
		]);
	}
}