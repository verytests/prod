<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Others\ParsedLink;
use AppBundle\Entity\Tests\SubCategory;
use AppBundle\Model\ServiceResponse;
use AppBundle\Services\HtmlTestParser;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ParseTestController
 * @package App\Controller\Admin
 *
 * @Route("/admin", name="admin_")
 */
class ParseTestController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/testparser", name="test_parser", methods={"GET"})
     */
    public function indexAction()
    {
        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        $categories = $testService->getCategories();

        return $this->render('Admin/parseTest/parseTest.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/testparseraction", name="test_parser_action", methods={"POST"})
     */
    public function parseAction(Request $request)
    {
        $url = $request->request->get('link');
        $category = $request->request->get('category');

        if(empty($category)) $category = 1;

        /** @var HtmlTestParser $testParser */
        $testParser = $this->get('app.htmlTestParser');

        $testData = $testParser->parseTest($url, $category);

        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        $output = $testService->addTest($testData);

        if($output[0] === ServiceResponse::ERROR) {
            return $this->errorResponse($output[1]);
        }

        return $this->successResponse();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/testparserfromdbaction", name="test_parser_from_db_action", methods={"POST"})
     */
    public function parseTestFromDb(Request $request)
    {
        $amount = $request->request->get('amount');
        $category = $request->request->get('category');

        $links = $this->getDoctrine()->getManager()->getRepository(ParsedLink::class)->getLinksForCategory($category, $amount);

        /** @var HtmlTestParser $testParser */
        $testParser = $this->get('app.htmlTestParser');

        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        foreach ($links as $link) {
            $url = $link->getLink();
            $subCatName = $link->getParsedCategoryName();

            $sub = $this->getDoctrine()->getManager()->getRepository(SubCategory::class)->findOneBy(['category' => $subCatName]);

            $subCatId = 1;

            if(!$sub) {
                $subCategory = new SubCategory();
                $subCategory
                    ->setCategoryId($category)
                    ->setCategory($subCatName);

                $this->getDoctrine()->getManager()->persist($subCategory);
                $this->getDoctrine()->getManager()->flush();
                $subCatId = $subCategory->getId();
            }

            $testData = $testParser->parseTest($url, $category, $subCatId);

            try {
                $testService->addTest($testData);
                $link->setIsAdded(true);
                $this->getDoctrine()->getManager()->persist($link);
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                continue;
            }
        }

        return $this->successResponse();

    }
}
