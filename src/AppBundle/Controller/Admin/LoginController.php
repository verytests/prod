<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Admin login controller
 *
 * Class LoginController
 * @package App\Controller\Admin
 *
 */

class LoginController extends BaseController
{
    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return mixed
     *
     * @Route("/admin", name="admin_login_page", methods={"GET","POST"})
     */
    public function loginRender(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('UserAuth/adminLoginPage.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
