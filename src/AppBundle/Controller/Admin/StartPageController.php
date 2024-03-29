<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StartPageController
 * @package App\Controller\admin
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
        $log = file_get_contents('https://verytests.com/var/logs/prod.log');
        return $this->render('admin/start_page/start_page.html.twig', [
            'log' => $log
        ]);
    }
}
