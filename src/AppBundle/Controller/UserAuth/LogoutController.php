<?php

namespace AppBundle\Controller\UserAuth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * @Route("/adminlogout", name="admin_logout", methods={"GET"})
     */
    public function adminLogout()
    {
       return $this->redirect($this->generateUrl('site_start_page'));
    }

    /**
     * @Route("/userlogout", name="user_logout", methods={"GET"})
     */
    public function userLogout()
    {
        return $this->redirect($this->generateUrl('site_start_page'));
    }
}
