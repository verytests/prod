<?php


namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CategoriesController
 * @package App\Controller\site\Categories
 *
 * @Route("/", name="site_")
 */
class SearchController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("search", name="search", methods={"GET"})
     */
    public function indexAction(Request $request)
    {
        $query = $request->query->get('query');

        /** @var TestItemService $testService */
        $testService = $this->get('app.testItem');

        $dbQuery = $testService->getTestsByQuery($query);
        $keywords = $testService->getKeywords();

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $dbQuery,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/search/search.html.twig', [
            'tests' => $tests,
            'search_query' => $query,
            'keywords' => $keywords
        ]);
    }
}
