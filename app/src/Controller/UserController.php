<?php

namespace App\Controller;

use App\Entity\User;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UserController extends AbstractController
{
       private $albumRepo;
    private $artistRepo;

     public function __construct(AlbumRepository $albumRepository, ArtistRepository $artistRepository)
    {
        $this->albumRepo = $albumRepository;
        $this->artistRepo = $artistRepository;
    }

    #[Route ('/user', name: 'userHome', methods: ['GET', 'POST'])]
    public function homeUser()
    {
        return $this->render('user/user.html.twig', [
            'albums' => $this->albumRepo->findAll(),
        ]);
    }
}