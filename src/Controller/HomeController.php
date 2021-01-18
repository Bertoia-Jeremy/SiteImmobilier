<?php

namespace App\Controller;

use Twig\Environment;
use App\Repository\OptionRepository;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    /**
        * @Route("/", name="home")
        * @param PropertyRepository $repository
        * @return Response
     */
    public function index(PropertyRepository $repository, OptionRepository $option): Response
    {

        $propertiesLast = $repository->findLatest();
        $propertiesBalcon = $repository->findByOption($option->findByName("Balcon"));
        $propertiesAscenseur = $repository->findByOption($option->findByName("Ascenseur"));

        return $this->render('pages/home.html.twig', [
            'current_menu' => 'Accueil',
            'properties_last' => $propertiesLast,
            'properties_balcon' => $propertiesBalcon,
            'properties_ascenseur' => $propertiesAscenseur
        ]);
    }
}
