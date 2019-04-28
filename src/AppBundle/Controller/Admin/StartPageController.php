<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StartPageController
 * @package App\Controller\Admin
 *
 * Start page controller.
 *
 * @Route("/admin", name="admin_")
 */
class StartPageController extends BaseController
{
    /**
     * Method to render start page
     *
     * @Route("/start", name="start_page", methods={"GET"})
     *
     */
    public function startPage()
    {
        return $this->render('Admin/startPage/startPage.html.twig');
    }
}
