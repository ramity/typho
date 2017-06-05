<?php

namespace StockBundle\Controller;

use StockBundle\Entity\Trend;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Trend controller.
 *
 * @Route("trend")
 */
class TrendController extends Controller
{
    /**
     * Lists all trend entities.
     *
     * @Route("/", name="trend_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trends = $em->getRepository('StockBundle:Trend')->findAll();

        return $this->render('trend/index.html.twig', array(
            'trends' => $trends,
        ));
    }

    /**
     * Creates a new trend entity.
     *
     * @Route("/new", name="trend_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trend = new Trend();
        $form = $this->createForm('StockBundle\Form\TrendType', $trend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trend);
            $em->flush();

            return $this->redirectToRoute('trend_show', array('id' => $trend->getId()));
        }

        return $this->render('trend/new.html.twig', array(
            'trend' => $trend,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a trend entity.
     *
     * @Route("/{id}", name="trend_show")
     * @Method("GET")
     */
    public function showAction(Trend $trend)
    {
        $deleteForm = $this->createDeleteForm($trend);

        return $this->render('trend/show.html.twig', array(
            'trend' => $trend,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing trend entity.
     *
     * @Route("/{id}/edit", name="trend_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Trend $trend)
    {
        $deleteForm = $this->createDeleteForm($trend);
        $editForm = $this->createForm('StockBundle\Form\TrendType', $trend);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trend_edit', array('id' => $trend->getId()));
        }

        return $this->render('trend/edit.html.twig', array(
            'trend' => $trend,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a trend entity.
     *
     * @Route("/{id}", name="trend_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Trend $trend)
    {
        $form = $this->createDeleteForm($trend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trend);
            $em->flush();
        }

        return $this->redirectToRoute('trend_index');
    }

    /**
     * Creates a form to delete a trend entity.
     *
     * @param Trend $trend The trend entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Trend $trend)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trend_delete', array('id' => $trend->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
