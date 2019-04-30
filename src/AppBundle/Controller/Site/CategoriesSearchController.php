<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use AppBundle\Model\Categories;
use AppBundle\Services\TestItemService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoriesController
 * @package App\Controller\site\Categories
 *
 * @Route("/", name="categories_")
 */
class CategoriesSearchController extends BaseController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alltests/search", name="all_search", methods={"GET"})
     */
    public function allQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q);
        if(empty($query)) {
            $query = $testService->getAllTests();
        }
        $keywords = $testService->getKeywords();
        $categoryMeta = $testService->getCategory(Categories::ALL);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/all.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0]
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/populartests/search", name="popular_search", methods={"GET"})
     */
    public function popularQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q);
        if(empty($query)) {
            $query = $testService->getAllTests();
        }
        $keywords = $testService->getKeywords();
        $categoryMeta = $testService->getCategory(Categories::POPULAR);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/popular.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0]
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/bookstests/search", name="books_search", methods={"GET"})
     */
    public function booksQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::BOOKS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::BOOKS);
        }
        $keywords = $testService->getKeywords(Categories::BOOKS);
        $categoryMeta = $testService->getCategory(Categories::BOOKS);
        $subCategories = $testService->getSubCategories(Categories::BOOKS);

        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/books.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/careertests/search", name="career_search", methods={"GET"})
     */
    public function careerQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::CAREER);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::CAREER);
        }

        $keywords = $testService->getKeywords(Categories::CAREER);
        $categoryMeta = $testService->getCategory(Categories::CAREER);
        $subCategories = $testService->getSubCategories(Categories::CAREER);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/career.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/eqtests/search", name="eq_search", methods={"GET"})
     */
    public function eqQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::EQ_TESTS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::EQ_TESTS);
        }

        $keywords = $testService->getKeywords(Categories::EQ_TESTS);
        $categoryMeta = $testService->getCategory(Categories::EQ_TESTS);
        $subCategories = $testService->getSubCategories(Categories::EQ_TESTS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/eq.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/forkidstests/search", name="for_kids_search", methods={"GET"})
     */
    public function forKidsQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::FOR_KIDS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::FOR_KIDS);
        }

        $keywords = $testService->getKeywords(Categories::FOR_KIDS);
        $categoryMeta = $testService->getCategory(Categories::FOR_KIDS);
        $subCategories = $testService->getSubCategories(Categories::FOR_KIDS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/forkids.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/gametests/search", name="game_search", methods={"GET"})
     */
    public function gameQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::GAME);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::GAME);
        }

        $keywords = $testService->getKeywords(Categories::GAME);
        $categoryMeta = $testService->getCategory(Categories::GAME);
        $subCategories = $testService->getSubCategories(Categories::GAME);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/game.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/healthtests/search", name="health_search", methods={"GET"})
     */
    public function healthQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::HEALTH);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::HEALTH);
        }

        $keywords = $testService->getKeywords(Categories::HEALTH);
        $categoryMeta = $testService->getCategory(Categories::HEALTH);
        $subCategories = $testService->getSubCategories(Categories::HEALTH);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/health.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/iqtests/search", name="iq_search", methods={"GET"})
     */
    public function iqQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::IQ_TESTS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::IQ_TESTS);
        }

        $keywords = $testService->getKeywords(Categories::IQ_TESTS);
        $categoryMeta = $testService->getCategory(Categories::IQ_TESTS);
        $subCategories = $testService->getSubCategories(Categories::IQ_TESTS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/iq.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/knowledgetests/search", name="knowledge_search", methods={"GET"})
     */
    public function knowledgeQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::KNOWLEDGE);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::KNOWLEDGE);
        }

        $keywords = $testService->getKeywords(Categories::KNOWLEDGE);
        $categoryMeta = $testService->getCategory(Categories::KNOWLEDGE);
        $subCategories = $testService->getSubCategories(Categories::KNOWLEDGE);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/knowledge.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/languagetests/search", name="language_search", methods={"GET"})
     */
    public function languageQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::LANGUAGE);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::LANGUAGE);
        }

        $keywords = $testService->getKeywords(Categories::LANGUAGE);
        $categoryMeta = $testService->getCategory(Categories::LANGUAGE);
        $subCategories = $testService->getSubCategories(Categories::LANGUAGE);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/language.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/movietests/search", name="movie_search", methods={"GET"})
     */
    public function movieQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::MOVIE);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::MOVIE);
        }

        $keywords = $testService->getKeywords(Categories::MOVIE);
        $categoryMeta = $testService->getCategory(Categories::MOVIE);
        $subCategories = $testService->getSubCategories(Categories::MOVIE);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/movie.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/musictests/search", name="music_search", methods={"GET"})
     */
    public function musicQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::MUSIC);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::MUSIC);
        }

        $keywords = $testService->getKeywords(Categories::MUSIC);
        $categoryMeta = $testService->getCategory(Categories::MUSIC);
        $subCategories = $testService->getSubCategories(Categories::MUSIC);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/music.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalitytests/search", name="personality_search", methods={"GET"})
     */
    public function personalityQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::PERSONALITY);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::PERSONALITY);
        }

        $keywords = $testService->getKeywords(Categories::PERSONALITY);
        $categoryMeta = $testService->getCategory(Categories::PERSONALITY);
        $subCategories = $testService->getSubCategories(Categories::PERSONALITY);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/personality.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/psychologytests/search", name="psychology_search", methods={"GET"})
     */
    public function psychologyQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::PSYCHOLOGY);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::PSYCHOLOGY);
        }

        $keywords = $testService->getKeywords(Categories::PSYCHOLOGY);
        $categoryMeta = $testService->getCategory(Categories::PSYCHOLOGY);
        $subCategories = $testService->getSubCategories(Categories::PSYCHOLOGY);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/psychology.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/puritytests/search", name="purity_search", methods={"GET"})
     */
    public function purityQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::PURITY_TESTS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::PURITY_TESTS);
        }

        $keywords = $testService->getKeywords(Categories::PURITY_TESTS);
        $categoryMeta = $testService->getCategory(Categories::PURITY_TESTS);
        $subCategories = $testService->getSubCategories(Categories::PURITY_TESTS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/purity.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/sporttests/search", name="sport_search", methods={"GET"})
     */
    public function sportQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::SPORT);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::SPORT);
        }

        $keywords = $testService->getKeywords(Categories::SPORT);
        $categoryMeta = $testService->getCategory(Categories::SPORT);
        $subCategories = $testService->getSubCategories(Categories::SPORT);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/sport.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/thinktests/search", name="think_search", methods={"GET"})
     */
    public function thinkQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::THINK);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::THINK);
        }

        $keywords = $testService->getKeywords(Categories::THINK);
        $categoryMeta = $testService->getCategory(Categories::THINK);
        $subCategories = $testService->getSubCategories(Categories::THINK);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/think.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/tvtests/search", name="tv_search", methods={"GET"})
     */
    public function tvQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::TV_SHOW);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::TV_SHOW);
        }

        $keywords = $testService->getKeywords(Categories::TV_SHOW);
        $categoryMeta = $testService->getCategory(Categories::TV_SHOW);
        $subCategories = $testService->getSubCategories(Categories::TV_SHOW);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/tv.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/youtubetests/search", name="youtube_search", methods={"GET"})
     */
    public function youtubeQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::YOUTUBE);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::YOUTUBE);
        }

        $keywords = $testService->getKeywords(Categories::YOUTUBE);
        $categoryMeta = $testService->getCategory(Categories::YOUTUBE);
        $subCategories = $testService->getSubCategories(Categories::YOUTUBE);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/youtube.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/funnytests/search", name="funny_search", methods={"GET"})
     */
    public function funnyQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::FUNNY);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::FUNNY);
        }

        $keywords = $testService->getKeywords(Categories::FUNNY);
        $categoryMeta = $testService->getCategory(Categories::FUNNY);
        $subCategories = $testService->getSubCategories(Categories::FUNNY);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );


        return $this->render('site/categories/funny.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/actor/search", name="actor_search", methods={"GET"})
     */
    public function actorQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::ACTOR);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::ACTOR);
        }

        $keywords = $testService->getKeywords(Categories::ACTOR);
        $categoryMeta = $testService->getCategory(Categories::ACTOR);
        $subCategories = $testService->getSubCategories(Categories::ACTOR);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/categories/actor.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/love/search", name="love_search", methods={"GET"})
     */
    public function loveQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::LOVE_TESTS);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::LOVE_TESTS);
        }

        $keywords = $testService->getKeywords(Categories::LOVE_TESTS);
        $categoryMeta = $testService->getCategory(Categories::LOVE_TESTS);
        $subCategories = $testService->getSubCategories(Categories::LOVE_TESTS);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/categories/love.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyformentests/search", name="only_for_men_search", methods={"GET"})
     */
    public function onlyForMenQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::ONLY_FOR_MEN);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::ONLY_FOR_MEN);
        }

        $keywords = $testService->getKeywords(Categories::ONLY_FOR_MEN);
        $categoryMeta = $testService->getCategory(Categories::ONLY_FOR_MEN);
        $subCategories = $testService->getSubCategories(Categories::ONLY_FOR_MEN);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/categories/onlyformen.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyforwomentests/search", name="only_for_women_search", methods={"GET"})
     */
    public function onlyForWomenQuery(Request $request)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $q = $request->query->get('q');

        $query = $testService->getTestsByQuery($q, Categories::ONLY_FOR_WOMEN);
        if(empty($query)) {
            $query = $testService->getTestsByCategory(Categories::ONLY_FOR_WOMEN);
        }

        $keywords = $testService->getKeywords(Categories::ONLY_FOR_WOMEN);
        $categoryMeta = $testService->getCategory(Categories::ONLY_FOR_WOMEN);
        $subCategories = $testService->getSubCategories(Categories::ONLY_FOR_WOMEN);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/categories/onlyforwomen.html.twig', [
            'tests' => $tests,
            'keywords' => $keywords,
            'categoryMeta' => $categoryMeta[0],
            'subCategories' => $subCategories
        ]);
    }
}
