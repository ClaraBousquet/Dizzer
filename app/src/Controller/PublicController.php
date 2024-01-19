<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

class PublicController extends AbstractController
{

    private $albumRepo;
    private $artistRepo;
    private $entityManager;

     public function __construct(AlbumRepository $albumRepository, ArtistRepository $artistRepository,EntityManagerInterface $entityManager)
    {
        $this->albumRepo = $albumRepository;
        $this->artistRepo = $artistRepository;
        $this->entityManager = $entityManager;
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

    public function addAlbumForm(Request $request)
    {
         $album = new Album();
        $form = $this->createForm(Album::class, $album);

        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($album);
        $this->entityManager->flush();
    }


        
    $albums = $this->entityManager->getRepository(Album::class)->findAll();

        return $this->render('album/ajouter_album.html.twig', [
            'form' => $form->createView(),
            'albums' => $albums,
        ]);

    }

}