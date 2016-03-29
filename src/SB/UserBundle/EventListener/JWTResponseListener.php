<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 21/03/16
 * Time: 21.12
 * Description: override default JWTResponseListener; here you can insert public data in the response
 */
namespace SB\UserBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTResponseListener
{
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();
        if (!$user instanceof UserInterface) {
            return;
        }
        // $data['token'] contains the JWT
        $data['data'] = array(
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        );
        $event->setData($data);
    }
}