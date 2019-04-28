<?php

namespace AppBundle\Controller\Error;

use AppBundle\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ErrorController
 * @package App\Controller\Error
 *
 * @Route("/error", name="error_")
 */

class ErrorController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="page", methods={"GET"})
     */
    public function errorPage()
    {
        return $this->render('errorPage.html.twig');
    }
}
