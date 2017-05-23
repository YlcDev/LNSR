<?php

namespace LBM\FrontPageBundle\Controller;

use LBM\FrontPageBundle\Entity\Multimedia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Multimedia controller.
 *
 * @Route("multimedia")
 */
class MultimediaController extends Controller
{
    /**
     * Lists all multimedia entities.
     *
     * @Route("/", name="multimedia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $multimedia = $em->getRepository('FrontPageBundle:Multimedia')->findAll();

        return $this->render('multimedia/index.html.twig', array(
            'multimedia' => $multimedia,
        ));
    }

    /**
     * Creates a new multimedia entity.
     *
     * @Route("/new", name="multimedia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $multimedia = new Multimedia();
        $form = $this->createForm('LBM\FrontPageBundle\Form\MultimediaType', $multimedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($multimedia);
            $em->flush();

            return $this->redirectToRoute('multimedia_show', array('id' => $multimedia->getId()));
        }

        return $this->render('multimedia/new.html.twig', array(
            'multimedia' => $multimedia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a multimedia entity.
     *
     * @Route("/{id}", name="multimedia_show")
     * @Method("GET")
     */
    public function showAction(Multimedia $multimedia)
    {
        $deleteForm = $this->createDeleteForm($multimedia);

        return $this->render('multimedia/show.html.twig', array(
            'multimedia' => $multimedia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing multimedia entity.
     *
     * @Route("/{id}/edit", name="multimedia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Multimedia $multimedia)
    {
        $deleteForm = $this->createDeleteForm($multimedia);
        $editForm = $this->createForm('LBM\FrontPageBundle\Form\MultimediaType', $multimedia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('multimedia_edit', array('id' => $multimedia->getId()));
        }

        return $this->render('multimedia/edit.html.twig', array(
            'multimedia' => $multimedia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a multimedia entity.
     *
     * @Route("/{id}", name="multimedia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Multimedia $multimedia)
    {
        $form = $this->createDeleteForm($multimedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($multimedia);
            $em->flush();
        }

        return $this->redirectToRoute('multimedia_index');
    }

    /**
     * Creates a form to delete a multimedia entity.
     *
     * @param Multimedia $multimedia The multimedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Multimedia $multimedia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('multimedia_delete', array('id' => $multimedia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
