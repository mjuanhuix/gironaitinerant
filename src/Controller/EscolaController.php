<?php

namespace App\Controller;

use App\Entity\Escola;
use App\Form\EscolaType;
use App\Repository\EscolaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escola")
 */
class EscolaController extends AbstractController
{
    /**
     * @Route("/", name="escola_index", methods="GET")
     */
    public function index(EscolaRepository $escolaRepository): Response
    {
        return $this->render('escola/index.html.twig', ['escolas' => $escolaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="escola_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $escola = new Escola();
        $form = $this->createForm(EscolaType::class, $escola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($escola);
            $em->flush();

            return $this->redirectToRoute('escola_index');
        }

        return $this->render('escola/new.html.twig', [
            'escola' => $escola,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="escola_Mostrar", methods="GET")
     */
    public function show(Escola $escola): Response
    {
        return $this->render('escola/show.html.twig', ['escola' => $escola]);
    }

    /**
     * @Route("/{id}/edit", name="escola_edit", methods="GET|POST")
     */
    public function edit(Request $request, Escola $escola): Response
    {
        $form = $this->createForm(EscolaType::class, $escola);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('escola_edit', ['id' => $escola->getId()]);
        }

        return $this->render('escola/edit.html.twig', [
            'escola' => $escola,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="escola_delete", methods="DELETE")
     */
    public function delete(Request $request, Escola $escola): Response
    {
        if ($this->isCsrfTokenValid('delete'.$escola->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($escola);
            $em->flush();
        }

        return $this->redirectToRoute('escola_index');
    }
}
