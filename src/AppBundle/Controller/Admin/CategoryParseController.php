<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Others\ParsedLink;
use AppBundle\Model\ServiceResponse;
use AppBundle\Services\CategoryParser;
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
class CategoryParseController extends BaseController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/categoryparser", name="category_parser", methods={"GET"})
     */
    public function indexAction()
    {
        $this->cleanDb();
        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        $categories = $testService->getCategories();

        return $this->render('admin/parse_category/parse_category.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/categoryparseraction", name="category_parser_action", methods={"POST"})
     */
    public function parseAction(Request $request)
    {
        $url = $request->request->get('link');
        $category = $request->request->get('category');
        $start = $request->request->get('start');
        $end = $request->request->get('end');

        /** @var CategoryParser $categoryParser */
        $categoryParser = $this->get('app.categoryParser');

        $output = $categoryParser->parseCategory($url, $category, $start, $end);

        if(!$output) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/subcategoryparseraction", name="sub_category_parser_action", methods={"POST"})
     */
    public function parseSub(Request $request)
    {
        $url = $request->request->get('link');
        $category = $request->request->get('category');
        $subCategory = $request->request->get('sub_category');

        /** @var CategoryParser $categoryParser */
        $categoryParser = $this->get('app.categoryParser');

        $output = $categoryParser->parseSubCategory($url, $category, $subCategory);

        if(!$output) {
            return $this->errorResponse();
        }

        return $this->successResponse();
    }

    public function cleanDb()
    {
        $conn = $this->getDoctrine()->getConnection();
        $em = $this->getDoctrine()->getManager();

        $sql = "
            SELECT link
            FROM parsed_links
            GROUP
            BY link
            HAVING COUNT(*) > 1
        ";

        $query = $conn->prepare($sql);
        $query->execute();

        $res = $query->fetchAll();

        foreach ($res as $item) {
            $links = $em->getRepository(ParsedLink::class)->findBy(['link' => $item['link']]);

            for($i = 1; $i < count($links); $i++) {
                $em->remove($links[$i]);
                $em->flush();
            }
        }
    }
}
