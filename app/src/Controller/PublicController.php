<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicController extends AbstractController
{

    private $albumRepo;

     public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepo = $albumRepository;
    }

    #[Route ('/index')]
    public function index()
    {
        return $this->render('public/index.html.twig');
    }

#[Route("/albums", name: "albums", methods: ['GET'])]
    public function getAlbums()
    {
        return $this->render("public/albums.html.twig", [
            "albums" => $this->albumRepo->findAll(),
              ]);
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