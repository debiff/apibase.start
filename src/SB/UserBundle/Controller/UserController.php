<?php

namespace SB\UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use SB\UserBundle\Controller\ApiController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\RestBundle\Controller\Annotations\Prefix;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Head;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Put;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @Prefix("")
 * @NamePrefix("api_v1_users_")
 */
class UserController extends Controller
{
    /**
     * @GET("/user")
     * @return array
     *
     */
    public function getUserAction()
    {
        $userManager = $this->container->get('fos_user.user_manager');

        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }
        $user=$userManager->findUserByUsername($this->getUser());
        $data=array(
            'data' => $user
        );
        return $data;
    }

}
