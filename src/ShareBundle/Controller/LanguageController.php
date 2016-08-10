<?php

namespace ShareBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ShareBundle\Entity\Language;

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

    public function newAction(Request $request)
    {
        $language = new Language();
        $form = $this->createForm('ShareBundle\Form\LanguageType', $language);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($language);
            $em->flush();

            return $this->redirectToRoute('language_index');
        }

        return $this->render('ShareBundle:Language:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $language = $em->getRepository('ShareBundle:Language')->findOneById($id);

        $edit_form = $this->createForm('ShareBundle\Form\LanguageType', $language);
        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid())
        {
            $em->persist($language);
            $em->flush();

            return $this->redirectToRoute('language_index');
        }

        return $this->render('ShareBundle:Language:edit.html.twig', array(
            'language' => $language,
            'edit_form' => $edit_form->createView()
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $language = $em->getRepository('ShareBundle:Language')->findOneById($id);

        if (empty($language) == false)
        {
            $em->remove($language);
            $em->flush();
        }

        return $this->redirectToRoute('language_index');
        
    }

}
