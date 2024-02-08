<?php

namespace App\Controller;

use App\Entity\User;

use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

     #[Route('/spotify-login', name: 'spotify_login')]
    public function spotifyLogin()
    {
        $clientId = '842c2af7ccd74bbb82957ba6929300f1 ';
        $redirectUri = 'http://localhost:8080/redirect';
        $scopes = 'user-read-private user-read-email';

        $authorizationUrl = 'https://accounts.spotify.com/authorize?' .
                            'response_type=code' .
                            '&client_id=' . $clientId .
                            '&scope=' . urlencode($scopes) .
                            '&redirect_uri=' . urlencode($redirectUri);

        // Rediriger l'utilisateur vers la page d'autorisation Spotify
        return new RedirectResponse($authorizationUrl);
    }

     #[Route('/redirect', name: 'spotify_redirect')]
    public function spotifyRedirect(Request $request)
    {
        // Récupérer le code d'autorisation depuis l'URL de redirection
        $code = $request->query->get('code');

        // Échangez le code d'autorisation contre un token d'accès en effectuant une demande à l'API Spotify
        // Vous devez implémenter cette partie pour échanger le code contre un token d'accès
        // Voir la section précédente pour un exemple de code

        // Une fois que vous avez obtenu le token d'accès, vous pouvez gérer la suite du processus
        // Rediriger l'utilisateur vers une autre page ou effectuer d'autres actions
        return new RedirectResponse($this->generateUrl('userHome'));
    }
}




