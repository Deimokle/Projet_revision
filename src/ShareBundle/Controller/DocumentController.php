<?php

namespace ShareBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ShareBundle\Entity\Document;
use ShareBundle\Form\DocumentType;

/**
 * Document controller.
 *
 */
class DocumentController extends Controller
{
    /**
     * Lists all Document entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository('ShareBundle:Document')->findAll();

        return $this->render('ShareBundle:document:index.html.twig', array(
            'documents' => $documents,
        ));
    }

    /**
     * Creates a new Document entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $securityContext = $this->container->get('security.authorization_checker');

/*        if (!$securityContext->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirectToRoute("fos_user_security_login");
        }*/

        $document = new Document();
        $form = $this->createForm('ShareBundle\Form\DocumentType', $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $document->setUsers($user);

            $document->setDatePublication(new \DateTime());
            $document->setDateModif(null);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', array('id' => $document->getId()));
        }

        return $this->render('ShareBundle:document:new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Document entity.
     *
     */
    public function showAction(Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('ShareBundle:document:show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Document entity.
     *
     */
    public function editAction(Request $request, Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);
        $editForm = $this->createForm('ShareBundle\Form\DocumentType', $document);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            if ($editForm->get('fichier')->getData() != null){
                $document->removeUpload();
                $document->preUpload();
            }

            $document->setDateModif(new \DateTime());

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_edit', array('id' => $document->getId()));
        }

        return $this->render('ShareBundle:document:edit.html.twig', array(
            'document' => $document,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Document entity.
     *
     */
    public function deleteAction(Request $request, Document $document)
    {
        $form = $this->createDeleteForm($document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('document_index');
    }

    /**
     * Creates a form to delete a Document entity.
     *
     * @param Document $document The Document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Document $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('document_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
