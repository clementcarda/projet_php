<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{



    public function indexAction(Request $request)
    {

        if ($this->getUser()){
            return $this->redirectToRoute('blog_homepage');
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }

    }

    public function listUserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //récupération de tous les Users
        $users = $em->getRepository('ClementBlogBundle:User')->findAll();
        $myId = $this->getUser()->getID();

        return $this->render('AppBundle:default:index.html.twig', [
            'users' => $users,
            'myId' => $myId
        ]);
    }
}
