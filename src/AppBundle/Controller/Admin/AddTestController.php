<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Model\ServiceResponse;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Add test section in admin dashboard
 *
 * @Route("/admin", name="admin_")
 */
class AddTestController extends BaseController
{
    /**
     * Index action
     *
     * @Route("/addtest", name="add_test", methods={"GET"})
     */
    public function indexAction()
    {
        /** @var TestItemService $testItemService */
        $testItemService = $this->get('app.testItem');

        $categories = $testItemService->getCategories();

        return $this->render('Admin/addTest/addTest.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * Method to add test
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/addtest/send", name="add_test_send", methods={"POST"})
     */
    public function getTestData(Request $request)
    {
        $testData = $request->request->get('testData');

        /** @var TestItemService $output */
        $output = $this->get('app.testItem')->addTest($testData);

        if($output[0] === ServiceResponse::ERROR) {
            return $this->errorResponse($output[1]);
        }

        return $this->successResponse();
    }
}
