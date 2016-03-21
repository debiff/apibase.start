<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 21/03/16
 * Time: 21.10
 * Description: override default JWTCreatedListener; insert here the additional field of your token
 */

namespace SB\UserBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }
        $expiration = new \DateTime('+1 day');
        $expiration->setTime(2, 0, 0);
        $payload       = $event->getData();
        $payload['ip'] = $request->getClientIp();
        $payload['exp'] = $expiration->getTimestamp();

        $event->setData($payload);
    }
}