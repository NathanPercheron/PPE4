<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Entity\Service;
use App\Entity\Partenaire;
use App\Repository\PackRepository;
use App\Repository\PartenaireRepository;
use App\Repository\ServiceRepository;
use App\Form\PackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\HttpFoundation\Request;

class PackServiceController extends AbstractController
{
    /**
     * @Route("/pack/service", name="pack_service")
     */
    public function getPack(PackRepository $repo)
    {
        $lespacks = $repo->findAll();
        return $this->render('pack_service/pack.html.twig', [
            'lespacks' => $lespacks
        ]);
    }

    /**
     * @Route("/pack/service/{id}", name="service_pack")
     */
    public function getService(PackRepository $repo, $id){

        $lesservices = $repo->findBy(
            ['id' => $id]
        );
        return $this->render('pack_service/service.html.twig',[
            'lesservices' => $lesservices
        ]);
    }

    /**
     * @Route("/pack/delete/{id}", name="delete_pack")
     */
    public function deletePacks($id){
        // On fais appelle a doctrine qui va nous lié à la base de donnée
        $entityManager = $this->getDoctrine()->getManager();
        // On créer une variable ou on lui affecte le repository de la class Pack avec l'id en paramètre
        $packs = $entityManager->getRepository(Pack::class)->find($id);
        // On fais appelle à la function remove qui viens s'effectuer sur l'id du pack séléctionné
        $entityManager->remove($packs);
        // On envoie la requête
        $entityManager->flush();
        $this->addFlash('message', 'Le pack à bien été supprimé !');
        return $this->redirectToRoute('pack_service');
    }

    /**
     * @Route("/pack/update/{id}", name="update_pack")
     */
    public function update(Pack $pack=null, Request $request)
    {
        dump($request);
        if(!$pack){
            $pack = new Pack;
        }
        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pack);
            $entityManager->flush();

            return $this->redirectToRoute('pack_service');
        }


        return $this->render('ajout_pack_service/ajout.html.twig',
        array('form' => $form->createView())
        );
    }

}
