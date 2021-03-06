<?php

namespace App\Controller;

use App\Entity\Ruta;
use App\Form\RutaType;
use App\Repository\RutaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ruta")
 */
class RutaController extends AbstractController
{
    /**
     * @Route("/", name="ruta_index", methods="GET")
     */
    public function index(RutaRepository $rutaRepository): Response
    {
        return $this->render('ruta/index.html.twig', ['rutas' => $rutaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="ruta_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $rutum = new Ruta();
        $form = $this->createForm(RutaType::class, $rutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rutum);
            $em->flush();

            return $this->redirectToRoute('ruta_index');
        }

        return $this->render('ruta/new.html.twig', [
            'rutum' => $rutum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ruta_Mostrar", methods="GET")
     */
    public function show(Ruta $rutum): Response
    {
        return $this->render('ruta/show.html.twig', ['rutum' => $rutum]);
    }

    /**
     * @Route("/{id}/edit", name="ruta_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ruta $rutum): Response
    {
        $form = $this->createForm(RutaType::class, $rutum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ruta_edit', ['id' => $rutum->getId()]);
        }

        return $this->render('ruta/edit.html.twig', [
            'rutum' => $rutum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ruta_delete", methods="DELETE")
     */
    public function delete(Request $request, Ruta $rutum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rutum->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rutum);
            $em->flush();
        }

        return $this->redirectToRoute('ruta_index');
    }
}
