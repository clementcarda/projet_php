<?php

namespace Clement\BlogBundle\Controller;

use Clement\BlogBundle\Entity\Article;
use Clement\BlogBundle\Entity\Commentaire;
use Clement\BlogBundle\form\CommentaireType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $titre = $session->get('recherche');


        $form = $this->createFormBuilder()
            ->add('rechercher', TextType::class, array(
                'data' => $titre
            ))
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $titre = $form->getData()['rechercher'];
            $session->set('recherche', $titre);
        }

        $articles = $this->getDoctrine()
            ->getRepository('ClementBlogBundle:Article')
            ->findAllByArray($titre);

        $session->set('recherche', null);

        return $this->render('ClementBlogBundle:Default:index.html.twig', [
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

    public function showArticleAction(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        if (!$article)
        {
            throw $this->createNotFoundException(
                'Aucun article pour cet identifant '.$id
            );
        }

        $em = $this->getDoctrine()->getManager();
        $comm = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $comm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {


            $comm = $form->getData();
            $user = $this->getUser();
            $date = new \DateTime("now");
            $comm->setDate($date);
            $comm->setAuteur($user);
            $comm->setArticle($article);

            $em->persist($comm);
            $em->flush();

            unset($form);
            unset($comm);
            $comm = new Commentaire();
            $form = $this->createForm(CommentaireType::class, $comm);



        }

        $commentaires = $this->getDoctrine()
            ->getRepository(Commentaire::class)->findByArticle($id);

        return $this->render('ClementBlogBundle:Default:article.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'commentaires' => $commentaires
        ]);
    }
}
