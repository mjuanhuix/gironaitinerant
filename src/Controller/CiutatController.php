<?php

namespace App\Controller;

use App\Entity\Ciutat;
use App\Form\CiutatType;
use App\Repository\CiutatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ciutat")
 */
class CiutatController extends AbstractController
{
    /**
     * @Route("/", name="ciutat_index", methods="GET")
     */
    public function index(CiutatRepository $ciutatRepository): Response
    {
        return $this->render('ciutat/index.html.twig', ['ciutats' => $ciutatRepository->findAll()]);
    }

    /**
     * @Route("/new", name="ciutat_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $ciutat = new Ciutat();
        $form = $this->createForm(CiutatType::class, $ciutat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ciutat);
            $em->flush();

            return $this->redirectToRoute('ciutat_index');
        }

        return $this->render('ciutat/new.html.twig', [
            'ciutat' => $ciutat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ciutat_Mostrar", methods="GET")
     */
    public function show(Ciutat $ciutat): Response
    {
        return $this->render('ciutat/show.html.twig', ['ciutat' => $ciutat]);
    }

    /**
     * @Route("/{id}/edit", name="ciutat_edit", methods="GET|POST")
     */
    public function edit(Request $request, Ciutat $ciutat): Response
    {
        $form = $this->createForm(CiutatType::class, $ciutat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ciutat_edit', ['id' => $ciutat->getId()]);
        }

        return $this->render('ciutat/edit.html.twig', [
            'ciutat' => $ciutat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ciutat_delete", methods="DELETE")
     */
    public function delete(Request $request, Ciutat $ciutat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ciutat->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ciutat);
            $em->flush();
        }

        return $this->redirectToRoute('ciutat_index');
    }
}
