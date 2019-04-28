<?php

namespace AppBundle\Controller\PrivateUser;

use AppBundle\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class StartPageController
 * @package App\Controller\Admin
 *
 * Start page controller.
 *
 * @Route("/private", name="private_")
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
        return $this->render('Private/startPage/startPage.html.twig');
    }
}
