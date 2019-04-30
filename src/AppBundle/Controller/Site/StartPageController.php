<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use AppBundle\Services\UserStatisticService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StartPageController
 * @package App\Controller\site
 *
 * Start page controller.
 *
 * @Route("/", name="site_")
 */
class StartPageController extends BaseController
{
    /**
     * Method to render start page
     *
     * @Route("", name="start_page", methods={"GET"})
     *
     */
    public function startPage()
    {
        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $topStatistic = $userStatistic->getMonthStatistic();

        return $this->render('site/start_page/index.html.twig', [
            'topStatistic' => $topStatistic
        ]);
    }
}
