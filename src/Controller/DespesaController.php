<?php

namespace App\Controller;

use App\Entity\Despesa;
use App\Form\DespesaType;
use App\Repository\DespesaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/despesa")
 */
class DespesaController extends AbstractController
{
    /**
     * @Route("/", name="despesa_index", methods="GET")
     */
    public function index(DespesaRepository $despesaRepository): Response
    {
        return $this->render('despesa/index.html.twig', ['despesas' => $despesaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="despesa_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $despesa = new Despesa();
        $form = $this->createForm(DespesaType::class, $despesa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($despesa);
            $em->flush();

            return $this->redirectToRoute('despesa_index');
        }

        return $this->render('despesa/new.html.twig', [
            'despesa' => $despesa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="despesa_Mostrar", methods="GET")
     */
    public function show(Despesa $despesa): Response
    {
        return $this->render('despesa/show.html.twig', ['despesa' => $despesa]);
    }

    /**
     * @Route("/{id}/edit", name="despesa_edit", methods="GET|POST")
     */
    public function edit(Request $request, Despesa $despesa): Response
    {
        $form = $this->createForm(DespesaType::class, $despesa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('despesa_edit', ['id' => $despesa->getId()]);
        }

        return $this->render('despesa/edit.html.twig', [
            'despesa' => $despesa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="despesa_delete", methods="DELETE")
     */
    public function delete(Request $request, Despesa $despesa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$despesa->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($despesa);
            $em->flush();
        }

        return $this->redirectToRoute('despesa_index');
    }
}
