<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Tests\TestItem;
use AppBundle\Model\ServiceResponse;
use AppBundle\Services\HtmlTestParser;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Add test section in admin dashboard
 *
 * @Route("/admin/managetests", name="admin_")
 */
class ManageTestsController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="manage_tests", methods={"GET"})
     */
    public function indexAction(Request $request)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
    {
        $testCategory = $request->query->get('category');
        $isChecked = $request->query->get('is_checked');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');
        $categories = $testService->getCategories();
        $query = $testService->getTestsByCategory($testCategory, $isChecked);

        /** @var HtmlTestParser $testParser */
        $testParser = $this->get('app.htmlTestParser');

        $available = $testParser->getAvailableAmount($categories, false);

        if(empty($query)) {
            $query = $testService->getAllNonCheckedTests();
        }

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->render('admin/manage_tests/manage_tests.html.twig', [
            'categories' => $categories,
            'tests' => $tests,
            'available' => $available
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/show", name="show_test_detail", methods={"GET"})
     */
    public function showTestDetails(Request $request)
    {
        $testId = $request->query->get('testId');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $test = $testService->getTestById($testId);

        return $this->render('admin/manage_tests/test_detail.html.twig', [
            'test' => $test
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/update", name="update_test", methods={"POST"})
     */
    public function updateTest(Request $request)
    {
        $testData = $request->request->get('testData');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $output = $testService->updateTest($testData);

        if($output != ServiceResponse::SUCCESS) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/delete", name="delete_test", methods={"GET"})
     */
    public function deleteTest(Request $request)
    {
        $testId = $request->query->get('testId');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $output = $testService->deleteTest($testId);

        if($output === ServiceResponse::ERROR) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/updatestatus", name="update_status", methods={"GET"})
     */
    public function updateTestStatus(Request $request)
    {
        $testId = $request->query->get('testId');
        $value = $request->query->get('value');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $output = $testService->setIsChecked($testId, $value);

        if($output === ServiceResponse::ERROR) {
            return $this->errorResponse();
        }

        return $this->redirect($this->generateUrl('admin_manage_tests'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/preview", name="preview_test", methods={"GET"})
     */
    public function previewAction(Request $request)
    {
        $testId = $request->query->get('testId');

        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $test = $testService->getTestById($testId);

        return $this->render('site/test/pass_test.html.twig', [
            'test' => $test
        ]);
    }

    /**
     * @Route("/setcheckedall", name="set_checked_all")
     */
    public function setCheckedAll()
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getAllNonCheckedTests();

        foreach ($query as $test) {
            $testService->setIsChecked($test->getId(), 1);
        }

        return $this->successResponse();
    }
}
