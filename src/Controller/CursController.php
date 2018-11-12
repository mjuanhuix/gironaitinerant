<?php

namespace App\Controller;

use App\Entity\Curs;
use App\Form\CursType;
use App\Repository\CursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/curs")
 */
class CursController extends AbstractController
{
    /**
     * @Route("/", name="curs_index", methods="GET")
     */
    public function index(CursRepository $cursRepository): Response
    {
        return $this->render('curs/index.html.twig', ['curs' => $cursRepository->findAll()]);
    }

    /**
     * @Route("/new", name="curs_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cur = new Curs();
        $form = $this->createForm(CursType::class, $cur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cur);
            $em->flush();

            return $this->redirectToRoute('curs_index');
        }

        return $this->render('curs/new.html.twig', [
            'cur' => $cur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="curs_Mostrar", methods="GET")
     */
    public function show(Curs $cur): Response
    {
        return $this->render('curs/show.html.twig', ['cur' => $cur]);
    }

    /**
     * @Route("/{id}/edit", name="curs_edit", methods="GET|POST")
     */
    public function edit(Request $request, Curs $cur): Response
    {
        $form = $this->createForm(CursType::class, $cur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('curs_edit', ['id' => $cur->getId()]);
        }

        return $this->render('curs/edit.html.twig', [
            'cur' => $cur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="curs_delete", methods="DELETE")
     */
    public function delete(Request $request, Curs $cur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cur->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cur);
            $em->flush();
        }

        return $this->redirectToRoute('curs_index');
    }
}
