<?php

namespace AppBundle\Controller\PrivateUser;

use AppBundle\Controller\BaseController;
use AppBundle\Services\UserStatisticService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class SavedTestsController
 * @package App\Controller\PrivateUser
 *
 * @Route("/private", name="private_")
 */
class SavedTestsController extends BaseController
{
    /**
     * @param Request $request
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/saved", name="saved_tests", methods={"GET"})
     */
    public function indexAction(Request $request, UserInterface $user)
    {
        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $query = $userStatistic->getSavedTests($user->getId());

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('private/saved_tests/saved_tests.html.twig', [
            'tests' => $tests
        ]);
    }

    /**
     * @param Request $request
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/savetest", name="save_test", methods={"POST"})
     */
    public function addSavedTest(Request $request, UserInterface $user)
    {
        $testId = $request->request->get('testId');

        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $userStatistic->addSavedTest($user->getId(), $testId);

        return $this->successResponse();
    }

    /**
     * @param UserInterface $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/getsavedtests", name="get_saved_tests", methods={"GET"})
     */
    public function getSavedTests(UserInterface $user)
    {
        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $savedTests = $userStatistic->getSavedTestsItems($user->getId());

        $saved = [];
        foreach($savedTests as $save) {
            $saved[] = $save->getTestId();
        }

        return $this->successResponse([
            'saved' => $saved
        ]);
    }
}
