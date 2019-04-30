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
 * @package App\Controller\admin
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

        $available = $this->getAvailableAmount($categories);

        return $this->render('admin/parse_test/parse_test.html.twig', [
            'categories' => $categories,
            'available' => $available
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/testparser/{id}", name="test_parser_show_links", methods={"GET"})
     */
    public function show(Request $request, $id)
    {
        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        $categories = $testService->getCategories();

        $query = $this->getDoctrine()->getManager()->getRepository(ParsedLink::class)->findBy(['categoryId' => $id]);

        $paginator = $this->get('knp_paginator');

        $links = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('admin/parse_test/show.html.twig', [
            'categories' => $categories,
            'links' => $links
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/upatelinkstatus", name="update_link_status")
     */
    public function updateLinkStatus(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository(ParsedLink::class)->findBy(['id' => $request->query->get('link_id')]);

        $link = $query[0];

        $link->setIsAdded($request->query->get('value'));

        $em->persist($link);
        $em->flush();

        return $this->successResponse();
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
        $link = $request->request->get('link');

        $em = $this->getDoctrine()->getManager();

        if(!$link) {
            $links = $this->getDoctrine()->getManager()->getRepository(ParsedLink::class)->getLinksForCategory($category, $amount);
        } else {
            $links = $this->getDoctrine()->getManager()->getRepository(ParsedLink::class)->findBy(['link' => $link]);
        }

        /** @var HtmlTestParser $testParser */
        $testParser = $this->get('app.htmlTestParser');

        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        foreach ($links as $link) {
            $url = $link->getLink();
            $subCatName = $link->getParsedCategoryName();

            $sub = $em->getRepository(SubCategory::class)->findOneBy(['category' => $subCatName]);

            if($sub) {
                $subCatId = $sub->getId();
            } else {
                $subCategory = new SubCategory();
                $subCategory
                    ->setCategoryId($category)
                    ->setCategory($subCatName);

                $em->persist($subCategory);
                $em->flush();
                $subCatId = $subCategory->getId();
            }

            $testData = $testParser->parseTest($url, $category, $subCatId);

            try
            {
                $testService->addTest($testData);
                $link->setIsAdded(true);
                $em->persist($link);
                $em->flush();
            } catch (\Exception $e)
            {
                return $this->errorResponse(['error' => $e->getMessage()]);
            }
        }

        return $this->successResponse();

    }

    public function getAvailableAmount($categories)
    {
        $connection = $this->getDoctrine()->getConnection();
        $result = [];

        $sql = '
        SELECT COUNT(id) as amount, category_id FROM parsed_links WHERE category_id = :catId AND is_added = :status
        ';

        foreach ($categories as $category) {
            $params = [
                'catId' => $category->getId(),
                'status' => 0
            ];

            $query = $connection->prepare($sql);
            $query->execute($params);
            $result[] = $query->fetch();
        }

        return $result;
    }
}
