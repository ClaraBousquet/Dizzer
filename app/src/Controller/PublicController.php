<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PublicController extends AbstractController
{

    private $albumRepo;
    private $artistRepo;

     public function __construct(AlbumRepository $albumRepository, ArtistRepository $artistRepository)
    {
        $this->albumRepo = $albumRepository;
        $this->artistRepo = $artistRepository;
    }

    #[Route ('/index', name: 'index')]
    public function index()
    {
        return $this->render('public/index.html.twig');
    }

#[Route("/albums", name: "albums", methods: ['GET'])]
    public function getAlbums()
    {
        //dump($this->albumRepo->findAll());
        return $this->render("public/albums.html.twig", [
            "albums" => $this->albumRepo->findAll(),

              ]);
    }

    #[Route("/artists", name: "artists", methods: ['GET'])]
    public function getArtists()
    {
        return $this->render("public/artists.html.twig", [
            "artists" => $this->artistRepo->findAll(),
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

#[Route('/addAlbum', name: 'addAlbum', methods: ['GET', 'POST'])]
    public function addAlbum()
    {
        return $this->render("public/addAlbum.html.twig");
    }

    #[Route("/album/{id}", name: "albumdetail", methods: ['GET'])]
    public function getOneAlbum(int $id)
    {
        return $this->render("public/albumDetails.html.twig", [
            "album" => $this->albumRepo->find($id),
        ]);
    }

}