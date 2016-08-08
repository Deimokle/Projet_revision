<?php

namespace ShareBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LanguageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $languages = $em->getRepository('ShareBundle:Language')->findAll();

        return $this->render('ShareBundle:Language:index.html.twig', array(
            'languages' => $languages
        ));
    }

    public function newAction()
    {
        
        return $this->render('ShareBundle:Language:new.html.twig', array(

        ));
    }

    public function editAction()
    {
        return $this->render('ShareBundle:Language:edit.html.twig', array(
            // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('ShareBundle:Language:delete.html.twig', array(
            // ...
        ));
    }

}
