<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use App\Form\PackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AjoutPackServiceController extends AbstractController
{
    /**
     * @Route("/ajout/pack/service", name="ajout_pack_service")
     */
    public function create(Pack $pack=null, Request $request)
    {
        if(!$pack){
            $pack = new Pack;
        }
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            dump($request);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pack);
            $entityManager->flush();

            return $this->redirectToRoute('ajout_pack_service');
        }


        return $this->render('ajout_pack_service/ajout.html.twig',
        array('form' => $form->createView())
        );
    }
}
