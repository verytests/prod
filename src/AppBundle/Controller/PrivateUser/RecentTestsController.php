<?php

namespace AppBundle\Controller\PrivateUser;

use AppBundle\Controller\BaseController;
use AppBundle\Services\UserStatisticService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class RecentTestsController
 * @package App\Controller\PrivateUser
 *
 * @Route("/private", name="private_")
 */
class RecentTestsController extends BaseController
{
    /**
     * @param Request $request
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/recent", name="recent_tests", methods={"GET"})
     */
    public function indexAction(Request $request, UserInterface $user)
    {
        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $query = $userStatistic->getRecentTests($user->getId());

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Private/recentTests/recentTests.html.twig', [
            'tests' => $tests
        ]);
    }
}
