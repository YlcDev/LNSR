<?php

namespace LBM\FrontPageBundle\Controller;

use LBM\FrontPageBundle\Entity\Developpement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Developpement controller.
 *
 * @Route("developpement")
 */
class DeveloppementController extends Controller
{
    /**
     * Lists all developpement entities.
     *
     * @Route("/", name="developpement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $developpements = $em->getRepository('FrontPageBundle:Developpement')->findAll();

        return $this->render('developpement/index.html.twig', array(
            'developpements' => $developpements,
        ));
    }

    /**
     * Creates a new developpement entity.
     *
     * @Route("/new", name="developpement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $developpement = new Developpement();
        $form = $this->createForm('LBM\FrontPageBundle\Form\DeveloppementType', $developpement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($developpement);
            $em->flush();

            return $this->redirectToRoute('developpement_show', array('id' => $developpement->getId()));
        }

        return $this->render('developpement/new.html.twig', array(
            'developpement' => $developpement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a developpement entity.
     *
     * @Route("/{id}", name="developpement_show")
     * @Method("GET")
     */
    public function showAction(Developpement $developpement)
    {
        $deleteForm = $this->createDeleteForm($developpement);

        return $this->render('developpement/show.html.twig', array(
            'developpement' => $developpement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing developpement entity.
     *
     * @Route("/{id}/edit", name="developpement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Developpement $developpement)
    {
        $deleteForm = $this->createDeleteForm($developpement);
        $editForm = $this->createForm('LBM\FrontPageBundle\Form\DeveloppementType', $developpement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('developpement_edit', array('id' => $developpement->getId()));
        }

        return $this->render('developpement/edit.html.twig', array(
            'developpement' => $developpement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a developpement entity.
     *
     * @Route("/{id}", name="developpement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Developpement $developpement)
    {
        $form = $this->createDeleteForm($developpement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($developpement);
            $em->flush();
        }

        return $this->redirectToRoute('developpement_index');
    }

    /**
     * Creates a form to delete a developpement entity.
     *
     * @param Developpement $developpement The developpement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Developpement $developpement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('developpement_delete', array('id' => $developpement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
