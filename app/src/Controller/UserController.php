<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class UserController extends AbstractController
{

    #[Route ('/user', name: 'userHome', methods: ['GET', 'POST'])]
    public function homeUser()
    {
        return $this->render('user/user.html.twig', [
        ]);
    }
}