<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Excursio;
use App\Entity\ExcursioDespesa;
use App\Form\ExcursioType;
use App\Repository\ExcursioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ExcursioController extends Controller{


    /**
     * @Route("/excursions_futures", name="excursion_futures", methods="GET")
     */
    public function futures( ExcursioRepository $excursioRepository){

        return $this->render('excursio/futur.html.twig', ['excursions' => $excursioRepository->futur(date('Y-m-d'))]);
    }

    /**
     * @Route("/excursio_nova", name="excursio_nova", methods="GET")
     */
    public function new(Request $request): Response{


        $excursio=new Excursio();
        $form=$this->createForm(ExcursioType::class,$excursio);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

                $em =$this->getDoctrine()->getManager();

                $excursio=$form->GetData();

                $file=$form["factura_signada"]->getData();
                if( !empty($file) && $file!=null){
                    $ext=$file->guessExtension();
                    $file_name=time().".".$ext;
                    $file->move("uploads",$file_name);
                    $excursio->setFacturaSignada($file_name);
                }
               // $excursion->setData("2018-01-01");


                $em->persist($excursio);
                $em->flush();


                return $this->redirectToRoute("excursions_futures");


        }


        return $this->render("excursio/nova.html.twig",array(
            'excursio'=>$excursio,
            "form"=>$form->CreateView()
        ));



    }


    /**
     * @Route("/{id}/excursio_editar", name="excursio_editar", methods="GET")
     */
    public function editAction(Excursio $excursio, Request $request){

        $form=$this->createForm(ExcursioType::class,$excursio);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em =$this->getDoctrine()->getManager();


            $excursio=$form->getData();

                $file=$form["factura_signada"]->getData();
                if( !empty($file) && $file!=null){
                    $ext=$file->guessExtension();
                    $file_name=time().".".$ext;
                    $file->move("uploads",$file_name);
                    $excursio->setFacturaSignada($file_name);
                }
               // $excursion->setData("2018-01-01");
               // $excursion->get('id_professor')->getData();

                $em->persist($excursio);
                $em->flush();

                //return $this->redidirectToRoute("excursio");

        }

        return $this->render("excursio/editar.html.twig",array(
            "form"=>$form->CreateView(),
            "excursio"=>$excursio
        ));
        
    }

    /**
     * @Route("/excursions_passades", name="excursio_nova", methods="GET")
     */

    public function pastAction(){
        $em=$this->getDoctrine()->GetManager();
        $query=$em->createQuery("select c from GironaItinerantBundle:Excursion c
        where c.data<= :dataActual order by c.data DESC")->setParameter("dataActual",date('Y-m-d'));

        $excursions=$query->getResult();

        return $this->render("GironaItinerantBundle:Excursion:past.html.twig",array(
                "excursions"=>$excursions)
        );
    }

    /**
     * @Route("/excursio_factura", name="excursio_factura", methods="GET")
     */
    public function billAction($id){



        $em=$this->getDoctrine()->GetManager();
        $exc_resp=$em->getRepository("GironaItinerantBundle:Excursion");
        $excursion=$exc_resp->find($id);

        $snappy=$this->get("Knp_snappy.pdf");
        $html= $this->renderView ("GironaItinerantBundle:Excursion:bill.html.twig",array(
            "excursion"=>$excursion
        ));

        $filename="custom_pdf_from_twig";

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'=>'application/pdf',
                'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'
            )
        );

    }


    /**
     * @Route("/excursio_confirmacio", name="excursio_confirmacio", methods="GET")
     */

    public function confirmAction($id){
        $em=$this->getDoctrine()->GetManager();
        $exc_repo=$em->getRepository("GironaItinerantBundle:Excursion");
        $excursion=$exc_repo->find($id);

        $snappy=$this->get("Knp_snappy.pdf");
        $html= $this->renderView ("GironaItinerantBundle:Excursion:confirm.html.twig",array(
            "excursion"=>$excursion
        ));

        $filename="custom_pdf_from_twig";

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'=>'application/pdf',
                'Content-Disposition'=>'inline; filename="'.$filename.'.pdf"'
            )
        );



    }
}


?>