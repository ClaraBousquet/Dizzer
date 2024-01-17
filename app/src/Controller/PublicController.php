<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{

    private $albumRepo;
    private $artistRepo;

     public function __construct(AlbumRepository $albumRepository, ArtistRepository $artistRepository)
    {
        $this->albumRepo = $albumRepository;
        $this->artistRepo = $artistRepository;
    }

    #[Route ('/index')]
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
    public function login()
    {
        return $this->render('public/login.html.twig');
    }

    #[Route("/album/{id}", name: "album", methods: ['GET'])]
    public function getAlbum(int $id)
    {
        //dump($this->bookRepo->find($id));
        return $this->render("public/album.html.twig", [
            "album" => $this->albumRepo->find($id),
        ]);
    }

}