<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use AppBundle\Model\Categories;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoriesController
 * @package App\Controller\Site\Categories
 *
 * @Route("/", name="categories_")
 */
class CategoriesController extends BaseController
{
    /**
     * All tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alltests", name="all", methods={"GET"})
     */
    public function allAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getAllTests();
        $keywords = $testService->getKeywords();
        $categoryMeta = $testService->getCategory(Categories::ALL);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/all.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0]
        ]);
    }

    /**
     * Popular tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/populartests", name="popular", methods={"GET"})
     */
    public function popularAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getPopularTests();
        $keywords = $testService->getKeywords();
        $categoryMeta = $testService->getCategory(Categories::POPULAR);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/popular.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0]
        ]);
    }

    /**
     * Funny tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/funnytests", name="funny", methods={"GET"})
     */
    public function funnyAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::FUNNY);
        $keywords = $testService->getKeywords(Categories::FUNNY);
        $categoryMeta = $testService->getCategory(Categories::FUNNY);
        $subCategories = $testService->getSubCategories(Categories::FUNNY);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/funny.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * For kids tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/forkidstests", name="forkids", methods={"GET"})
     */
    public function forKidsAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::FOR_KIDS);
        $keywords = $testService->getKeywords(Categories::FOR_KIDS);
        $categoryMeta = $testService->getCategory(Categories::FOR_KIDS);
        $subCategories = $testService->getSubCategories(Categories::FOR_KIDS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/forkids.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Psychology tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/psychologytests", name="psychology", methods={"GET"})
     */
    public function psychologyAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::PSYCHOLOGY);
        $keywords = $testService->getKeywords(Categories::PSYCHOLOGY);
        $categoryMeta = $testService->getCategory(Categories::PSYCHOLOGY);
        $subCategories = $testService->getSubCategories(Categories::PSYCHOLOGY);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/all.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Love tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/lovetests", name="love", methods={"GET"})
     */
    public function loveTestsAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::LOVE_TESTS);
        $keywords = $testService->getKeywords(Categories::LOVE_TESTS);
        $categoryMeta = $testService->getCategory(Categories::LOVE_TESTS);
        $subCategories = $testService->getSubCategories(Categories::LOVE_TESTS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/love.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Only for men tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyformentests", name="only_for_men", methods={"GET"})
     */
    public function onlyForMenAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::ONLY_FOR_MEN);
        $keywords = $testService->getKeywords(Categories::ONLY_FOR_MEN);
        $categoryMeta = $testService->getCategory(Categories::ONLY_FOR_MEN);
        $subCategories = $testService->getSubCategories(Categories::ONLY_FOR_MEN);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/onlyformen.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Only for women tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyforwomentests", name="only_for_women", methods={"GET"})
     */
    public function onlyForWomenAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::ONLY_FOR_WOMEN);
        $keywords = $testService->getKeywords(Categories::ONLY_FOR_WOMEN);
        $categoryMeta = $testService->getCategory(Categories::ONLY_FOR_WOMEN);
        $subCategories = $testService->getSubCategories(Categories::ONLY_FOR_WOMEN);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/onlyforwomen.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Personality tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalitytests", name="personality", methods={"GET"})
     */
    public function personalityAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::PERSONALITY);
        $keywords = $testService->getKeywords(Categories::PERSONALITY);
        $categoryMeta = $testService->getCategory(Categories::PERSONALITY);
        $subCategories = $testService->getSubCategories(Categories::PERSONALITY);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/personality.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * IQ tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/iqtests", name="iq", methods={"GET"})
     */
    public function iqTestsAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::IQ_TESTS);
        $keywords = $testService->getKeywords(Categories::IQ_TESTS);
        $categoryMeta = $testService->getCategory(Categories::IQ_TESTS);
        $subCategories = $testService->getSubCategories(Categories::IQ_TESTS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/iq.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Actor tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/actor", name="actor", methods={"GET"})
     */
    public function actorAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::ACTOR);
        $keywords = $testService->getKeywords(Categories::ACTOR);
        $categoryMeta = $testService->getCategory(Categories::ACTOR);
        $subCategories = $testService->getSubCategories(Categories::ACTOR);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/actor.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Books tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/bookstests", name="books", methods={"GET"})
     */
    public function booksAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::BOOKS);
        $keywords = $testService->getKeywords(Categories::BOOKS);
        $categoryMeta = $testService->getCategory(Categories::BOOKS);
        $subCategories = $testService->getSubCategories(Categories::BOOKS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/books.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Career tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/careertests", name="career", methods={"GET"})
     */
    public function careerAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::CAREER);
        $keywords = $testService->getKeywords(Categories::CAREER);
        $categoryMeta = $testService->getCategory(Categories::CAREER);
        $subCategories = $testService->getSubCategories(Categories::CAREER);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/career.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * EQ tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/eqtests", name="eq", methods={"GET"})
     */
    public function eqTestsAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::EQ_TESTS);
        $keywords = $testService->getKeywords(Categories::EQ_TESTS);
        $categoryMeta = $testService->getCategory(Categories::EQ_TESTS);
        $subCategories = $testService->getSubCategories(Categories::EQ_TESTS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/eq.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Game tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/gametests", name="game", methods={"GET"})
     */
    public function gameAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::GAME);
        $keywords = $testService->getKeywords(Categories::GAME);
        $categoryMeta = $testService->getCategory(Categories::GAME);
        $subCategories = $testService->getSubCategories(Categories::GAME);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/game.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Health tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/healthtests", name="health", methods={"GET"})
     */
    public function healthAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::HEALTH);
        $keywords = $testService->getKeywords(Categories::HEALTH);
        $categoryMeta = $testService->getCategory(Categories::HEALTH);
        $subCategories = $testService->getSubCategories(Categories::HEALTH);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/health.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Knowledge tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/knowledgetests", name="knowledge", methods={"GET"})
     */
    public function knowledgeAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::KNOWLEDGE);
        $keywords = $testService->getKeywords(Categories::KNOWLEDGE);
        $categoryMeta = $testService->getCategory(Categories::KNOWLEDGE);
        $subCategories = $testService->getSubCategories(Categories::KNOWLEDGE);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/knowledge.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Language tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/languagetests", name="language", methods={"GET"})
     */
    public function languageAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::LANGUAGE);
        $keywords = $testService->getKeywords(Categories::LANGUAGE);
        $categoryMeta = $testService->getCategory(Categories::LANGUAGE);
        $subCategories = $testService->getSubCategories(Categories::LANGUAGE);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/language.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Movie tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/movietests", name="movie", methods={"GET"})
     */
    public function movieAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::MOVIE);
        $keywords = $testService->getKeywords(Categories::MOVIE);
        $categoryMeta = $testService->getCategory(Categories::MOVIE);
        $subCategories = $testService->getSubCategories(Categories::MOVIE);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/movie.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Music tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/musictests", name="music", methods={"GET"})
     */
    public function musicAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::MUSIC);
        $keywords = $testService->getKeywords(Categories::MUSIC);
        $categoryMeta = $testService->getCategory(Categories::MUSIC);
        $subCategories = $testService->getSubCategories(Categories::MUSIC);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/music.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Purity tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/puritytests", name="purity", methods={"GET"})
     */
    public function purityAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::PURITY_TESTS);
        $keywords = $testService->getKeywords(Categories::PURITY_TESTS);
        $categoryMeta = $testService->getCategory(Categories::PURITY_TESTS);
        $subCategories = $testService->getSubCategories(Categories::PURITY_TESTS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/purity.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Sport tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/sporttests", name="sport", methods={"GET"})
     */
    public function sportAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::SPORT);
        $keywords = $testService->getKeywords(Categories::SPORT);
        $categoryMeta = $testService->getCategory(Categories::SPORT);
        $subCategories = $testService->getSubCategories(Categories::SPORT);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/sport.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Think tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/thinktests", name="think", methods={"GET"})
     */
    public function thinkAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::THINK);
        $keywords = $testService->getKeywords(Categories::THINK);
        $categoryMeta = $testService->getCategory(Categories::THINK);
        $subCategories = $testService->getSubCategories(Categories::THINK);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/think.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * TV show tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/tvtests", name="tv", methods={"GET"})
     */
    public function tvAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::TV_SHOW);
        $keywords = $testService->getKeywords(Categories::TV_SHOW);
        $categoryMeta = $testService->getCategory(Categories::TV_SHOW);
        $subCategories = $testService->getSubCategories(Categories::TV_SHOW);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/tv.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Youtube tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/youtubetests", name="youtube", methods={"GET"})
     */
    public function youtubeAction(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsByCategory(Categories::YOUTUBE);
        $keywords = $testService->getKeywords(Categories::YOUTUBE);
        $categoryMeta = $testService->getCategory(Categories::YOUTUBE);
        $subCategories = $testService->getSubCategories(Categories::YOUTUBE);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('Site/categories/youtube.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }
}
