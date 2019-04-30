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
class SubCategoriesController extends BaseController
{
    /**
     * Funny tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/funnytests/{id}", name="funny_sub", methods={"GET"})
     */
    public function funnyAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * For kids tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/forkidstests/{id}", name="for_kids_sub", methods={"GET"})
     */
    public function forKidsAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Psychology tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/psychologytests/{id}", name="psychology_sub", methods={"GET"})
     */
    public function psychologyAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
        $keywords = $testService->getKeywords(Categories::PSYCHOLOGY);
        $categoryMeta = $testService->getCategory(Categories::PSYCHOLOGY);
        $subCategories = $testService->getSubCategories(Categories::PSYCHOLOGY);


        $paginator = $this->get('knp_paginator');

        $tests = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 12)
        );

        return $this->render('site/categories/all.html.twig', [
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
     * @Route("/lovetests/{id}", name="love_sub", methods={"GET"})
     */
    public function loveTestsAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Only for men tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyformentests/{id}", name="only_for_men_sub", methods={"GET"})
     */
    public function onlyForMenAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Only for women tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/onlyforwomentests/{id}", name="only_for_women_sub", methods={"GET"})
     */
    public function onlyForWomenAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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

    /**
     * Personality tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalitytests/{id}", name="personality_sub", methods={"GET"})
     */
    public function personalityAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * IQ tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/iqtests/{id}", name="iq_sub", methods={"GET"})
     */
    public function iqTestsAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Actor tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/actor/{id}", name="actor_sub", methods={"GET"})
     */
    public function actorAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Books tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/bookstests/{id}", name="books_sub", methods={"GET"})
     */
    public function booksAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Career tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/careertests/{id}", name="career_sub", methods={"GET"})
     */
    public function careerAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * EQ tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/eqtests/{id}", name="eq_sub", methods={"GET"})
     */
    public function eqTestsAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Game tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/gametests/{id}", name="game_sub", methods={"GET"})
     */
    public function gameAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Health tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/healthtests/{id}", name="health_sub", methods={"GET"})
     */
    public function healthAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Knowledge tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/knowledgetests/{id}", name="knowledge_sub", methods={"GET"})
     */
    public function knowledgeAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Language tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/languagetests/{id}", name="language_sub", methods={"GET"})
     */
    public function languageAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Movie tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/movietests/{id}", name="movie_sub", methods={"GET"})
     */
    public function movieAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Music tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/musictests/{id}", name="music_sub", methods={"GET"})
     */
    public function musicAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Purity tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/puritytests/{id}", name="purity_sub", methods={"GET"})
     */
    public function purityAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Sport tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/sporttests/{id}", name="sport_sub", methods={"GET"})
     */
    public function sportAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Think tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/thinktests/{id}", name="think_sub", methods={"GET"})
     */
    public function thinkAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * TV show tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/tvtests/{id}", name="tv_sub", methods={"GET"})
     */
    public function tvAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
     * Youtube tests
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/youtubetests/{id}", name="youtube_sub", methods={"GET"})
     */
    public function youtubeAction(Request $request, $id)
    {
        /** @var  TestItemService $testService */
        $testService = $this->get('app.testItem');

        $query = $testService->getTestsBySubId($id);
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
}
