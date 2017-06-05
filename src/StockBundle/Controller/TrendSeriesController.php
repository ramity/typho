<?php

namespace StockBundle\Controller;

use StockBundle\Entity\TrendSeries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Trendseries controller.
 *
 * @Route("trend/series")
 */
class TrendSeriesController extends Controller
{
    /**
     * Lists all trendSeries entities.
     *
     * @Route("/", name="trend_series_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trendSeries = $em->getRepository('StockBundle:TrendSeries')->findAll();

        return $this->render('trendseries/index.html.twig', array(
            'trendSeries' => $trendSeries,
        ));
    }

    /**
     * Creates a new trendSeries entity.
     *
     * @Route("/new", name="trend_series_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $trendSeries = new Trendseries();
        $form = $this->createForm('StockBundle\Form\TrendSeriesType', $trendSeries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($trendSeries);
            $em->flush();

            return $this->redirectToRoute('trend_series_show', array('id' => $trendSeries->getId()));
        }

        return $this->render('trendseries/new.html.twig', array(
            'trendSeries' => $trendSeries,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a trendSeries entity.
     *
     * @Route("/{id}", name="trend_series_show")
     * @Method("GET")
     */
    public function showAction(TrendSeries $trendSeries)
    {
        $deleteForm = $this->createDeleteForm($trendSeries);

        return $this->render('trendseries/show.html.twig', array(
            'trendSeries' => $trendSeries,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing trendSeries entity.
     *
     * @Route("/{id}/edit", name="trend_series_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TrendSeries $trendSeries)
    {
        $deleteForm = $this->createDeleteForm($trendSeries);
        $editForm = $this->createForm('StockBundle\Form\TrendSeriesType', $trendSeries);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trend_series_edit', array('id' => $trendSeries->getId()));
        }

        return $this->render('trendseries/edit.html.twig', array(
            'trendSeries' => $trendSeries,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a trendSeries entity.
     *
     * @Route("/{id}", name="trend_series_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TrendSeries $trendSeries)
    {
        $form = $this->createDeleteForm($trendSeries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($trendSeries);
            $em->flush();
        }

        return $this->redirectToRoute('trend_series_index');
    }

    /**
     * Creates a form to delete a trendSeries entity.
     *
     * @param TrendSeries $trendSeries The trendSeries entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TrendSeries $trendSeries)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('trend_series_delete', array('id' => $trendSeries->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
