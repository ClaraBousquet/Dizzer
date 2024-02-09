<?php
 
namespace App\EventSubscriber;
 
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
 
class PasswordHashSubscriber implements EventSubscriberInterface
{
    private $encoder;
 
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }
 
    public static function getSubscribedEvents()
    {
        return [
            //index le lieu de déclanchement; EventPrioritie => quand
            KernelEvents::VIEW => ["hasPassword", EventPriorities::PRE_WRITE]
        ];
    }
 
    public function hashPassword(ViewEvent $event)//methode declencher par l'intercepteur
    {
        $user = $event->getControllerResult(); //recup l'enveloppe passé par json
        $method = $event->getRequest()->getMethod(); //recup de la methode
 
        if(!$user instanceof User || $method !== Request::METHOD_POST){
            
        }
 
        //encodage du mdp en claire
        $user->setPassword($this->encoder->hashPassword($user, $user->getPassword()));
 
    }
 
}
