<?php

namespace AppBundle\Controller\UserAuth;

use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginController
 * @package App\Controller\PrivateUser
 *
 * User private login controller
 */

class LoginController extends BaseController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return mixed
     *
     * @Route("/private", name="private_login_page", methods={"GET","POST"})
     */
    public function loginRender(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user_auth/user_login_page.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
