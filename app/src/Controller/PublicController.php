<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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


#[Route ('/searchArtist', name: 'searchArtist', methods: ['GET'])]
public function searchArtist()
{
    $client = HttpClient::create();

    $accessToken = '';

$url = 'https://api.spotify.com/v1/search?q=Shawn+Mendes&type=artist';

$response = $client->request('GET', $url, [
    'headers' => [
        'Authorization' => 'Bearer ' . $accessToken,
    ],
]);
$content = $response->getContent();
return new Response($content);
    
}

#[Route('/redirect', name: 'spotify_redirect')]
    public function spotifyRedirect(Request $request)
    {
        // Récupérer le code d'autorisation depuis l'URL de redirection
        $code = $request->query->get('code');

        // Remplacez les valeurs suivantes par vos propres identifiants Spotify
        $clientId = 'VOTRE_CLIENT_ID';
        $clientSecret = 'VOTRE_CLIENT_SECRET';
        $redirectUri = 'http://localhost:8080/redirect';

        // Construire le corps de la demande POST pour échanger le code d'autorisation contre un token d'accès
        $postData = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        // Effectuer une demande POST à l'endpoint d'authentification de Spotify pour échanger le code d'autorisation contre un token d'accès
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://accounts.spotify.com/api/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => http_build_query($postData),
        ]);
        // Analyser la réponse JSON
        $data = $response->toArray();
        // Récupérer le token d'accès à partir de la réponse
        $accessToken = $data['access_token'];
        // Vous pouvez maintenant utiliser $accessToken pour accéder à l'API Spotify
        // Rediriger l'utilisateur vers une autre page, par exemple, la page d'accueil de votre application
        return new RedirectResponse($this->generateUrl('home'));
    }





    #[Route ('/index', name: 'index')]
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

    #[Route("/artists", name: "artists", methods: ['GET'])]
    public function getArtists()
    {
           // Créez une instance du client HTTP
    $client = HttpClient::create();
    
    // Remplacez 'YOUR_ACCESS_TOKEN' par votre propre token d'accès à l'API Spotify
    $accessToken = 'BQDbUTzfqc7gvlWG-Ty9VleI302FF
8lp60f6-LWaBMAl-MB1nMARCMihhfsdjRyMQi5PcmTm5Ab1jR2CnNbT_GXftYduLbsVBqykpl5hyzAYqq1tJqog';
    
    // URL de l'endpoint de recherche d'albums sur Spotify
    $url = 'https://api.spotify.com/v1/search?q=nirvana&type=album';

    // Effectuez une requête GET pour récupérer les données des albums depuis l'API Spotify
    $response = $client->request('GET', $url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
        ],
    ]);

    // Récupérez les données sous forme de tableau associatif
    $albumsData = $response->toArray();

    // Passez les données des albums à votre vue Twig
    return $this->render("public/albums.html.twig", [
        "albums" => $albumsData['albums']['items'],
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








  
















 





















 

 
