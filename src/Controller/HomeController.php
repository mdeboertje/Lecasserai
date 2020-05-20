<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(RoomRepository $roomRepository)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'rooms' => $roomRepository->findAll()
        ]);
    }
}
