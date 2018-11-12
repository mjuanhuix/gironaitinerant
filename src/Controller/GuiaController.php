<?php

namespace App\Controller;

use App\Entity\Guia;
use App\Form\GuiaType;
use App\Repository\GuiaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guia")
 */
class GuiaController extends AbstractController
{
    /**
     * @Route("/", name="guia_index", methods="GET")
     */
    public function index(GuiaRepository $guiaRepository): Response
    {
        return $this->render('guia/index.html.twig', ['guias' => $guiaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="guia_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $guium = new Guia();
        $form = $this->createForm(GuiaType::class, $guium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($guium);
            $em->flush();

            return $this->redirectToRoute('guia_index');
        }

        return $this->render('guia/new.html.twig', [
            'guium' => $guium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guia_Mostrar", methods="GET")
     */
    public function show(Guia $guium): Response
    {
        return $this->render('guia/show.html.twig', ['guium' => $guium]);
    }

    /**
     * @Route("/{id}/edit", name="guia_edit", methods="GET|POST")
     */
    public function edit(Request $request, Guia $guium): Response
    {
        $form = $this->createForm(GuiaType::class, $guium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('guia_edit', ['id' => $guium->getId()]);
        }

        return $this->render('guia/edit.html.twig', [
            'guium' => $guium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="guia_delete", methods="DELETE")
     */
    public function delete(Request $request, Guia $guium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guium->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guium);
            $em->flush();
        }

        return $this->redirectToRoute('guia_index');
    }
}
