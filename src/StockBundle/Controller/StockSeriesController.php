<?php

namespace StockBundle\Controller;

use StockBundle\Entity\StockSeries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Stockseries controller.
 *
 * @Route("stock/series")
 */
class StockSeriesController extends Controller
{
    /**
     * Lists all stockSeries entities.
     *
     * @Route("/", name="stock_series_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stockSeries = $em->getRepository('StockBundle:StockSeries')->findAll();

        return $this->render('stockseries/index.html.twig', array(
            'stockSeries' => $stockSeries,
        ));
    }

    /**
     * Creates a new stockSeries entity.
     *
     * @Route("/new", name="stock_series_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $stockSeries = new Stockseries();
        $form = $this->createForm('StockBundle\Form\StockSeriesType', $stockSeries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stockSeries);
            $em->flush();

            return $this->redirectToRoute('stock_series_show', array('id' => $stockSeries->getId()));
        }

        return $this->render('stockseries/new.html.twig', array(
            'stockSeries' => $stockSeries,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a stockSeries entity.
     *
     * @Route("/{id}", name="stock_series_show")
     * @Method("GET")
     */
    public function showAction(StockSeries $stockSeries)
    {
        $deleteForm = $this->createDeleteForm($stockSeries);

        return $this->render('stockseries/show.html.twig', array(
            'stockSeries' => $stockSeries,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing stockSeries entity.
     *
     * @Route("/{id}/edit", name="stock_series_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, StockSeries $stockSeries)
    {
        $deleteForm = $this->createDeleteForm($stockSeries);
        $editForm = $this->createForm('StockBundle\Form\StockSeriesType', $stockSeries);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stock_series_edit', array('id' => $stockSeries->getId()));
        }

        return $this->render('stockseries/edit.html.twig', array(
            'stockSeries' => $stockSeries,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a stockSeries entity.
     *
     * @Route("/{id}", name="stock_series_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, StockSeries $stockSeries)
    {
        $form = $this->createDeleteForm($stockSeries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stockSeries);
            $em->flush();
        }

        return $this->redirectToRoute('stock_series_index');
    }

    /**
     * Creates a form to delete a stockSeries entity.
     *
     * @param StockSeries $stockSeries The stockSeries entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StockSeries $stockSeries)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stock_series_delete', array('id' => $stockSeries->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
