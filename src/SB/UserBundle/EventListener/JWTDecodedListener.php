<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 21/03/16
 * Time: 21.11
 * Description: override default JWTDecodedListener; here you can perform you own additional validation.
 */

namespace SB\UserBundle\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;

class JWTDecodedListener
{
    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }

        $payload = $event->getPayload();
        $request = $event->getRequest();

        if (!isset($payload['ip']) || $payload['ip'] !== $request->getClientIp()) {
            $event->markAsInvalid();
        }
    }
}