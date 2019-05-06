<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Repository\PackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function getPack(PackRepository $repo)
    {
        $lespacks = $repo->findAll();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'lespacks' => $lespacks
        ]);
    }
    
}
