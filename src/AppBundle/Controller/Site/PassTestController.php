<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use AppBundle\Services\TestItemService;
use AppBundle\Services\UserStatisticService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class PassTestController
 * @package App\Controller\site
 *
 * @Route("/test", name="test_")
 */
class PassTestController extends BaseController
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{name}", methods={"GET"}, name="pass")
     */
    public function passTest($name)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $id = $testService->getTestIdByUrlName($name);

        $test = $testService->getTestById($id);

        return $this->render('site/test/pass_test.html.twig', [
            'test' => $test
        ]);
    }

    /**
     * @param Request $request
     * @param $name
     * @param UserInterface|null $user
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{name}/result", methods={"POST"}, name="result")
     */
    public function resultOfTest(Request $request, $name, UserInterface $user = null)
    {
        $req = $request->request->all();

        $answers = [];

        foreach ($req as $key => $value) {
            $check = substr($key, 0, 6);

            if($check === 'answer') {
                $answers[] = $value;
            }
        }

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        /** @var UserStatisticService $userStatistic */
        $userStatistic = $this->get('app.userStatistic');

        $id = $testService->getTestIdByUrlName($name);

        $result = $testService->getResultOfTest($answers, $id);
        $testService->addPassedCount($id);
        $userStatistic->addPassed($id);

        if($user) {
            $recent = $userStatistic->getRecentTestItemById($user->getId(), $id);

            if(!$recent) {
                $userStatistic->addRecentTest($user->getId(), $id);
            }
        }

        $test = $testService->getTestById($id);

        return $this->render('site/test/result_test.html.twig', [
            'result' => $result,
            'test' => $test
        ]);
    }
}
