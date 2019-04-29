<?php


namespace AppBundle\Controller\Others;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Tests\Categories;
use AppBundle\Entity\Tests\TestItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends BaseController
{
    /**
     * @Route("/sitemap.xml", name="sitemap")
     */
    public function showAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $urls = [];
        $hostname = $request->getSchemeAndHttpHost();

        // add static urls
        $urls[] = ['loc' => $this->generateUrl('private_login_page')];
        $urls[] = ['loc' => $this->generateUrl('signup_page')];
        $urls[] = ['loc' => $this->generateUrl('categories_all')];
        $urls[] = ['loc' => $this->generateUrl('categories_popular')];
        $urls[] = ['loc' => $this->generateUrl('categories_funny')];
        $urls[] = ['loc' => $this->generateUrl('categories_forkids')];
        $urls[] = ['loc' => $this->generateUrl('categories_psychology')];
        $urls[] = ['loc' => $this->generateUrl('categories_love')];
        $urls[] = ['loc' => $this->generateUrl('categories_only_for_men')];
        $urls[] = ['loc' => $this->generateUrl('categories_only_for_women')];
        $urls[] = ['loc' => $this->generateUrl('categories_personality')];
        $urls[] = ['loc' => $this->generateUrl('categories_iq')];
        $urls[] = ['loc' => $this->generateUrl('categories_actor')];
        $urls[] = ['loc' => $this->generateUrl('categories_books')];
        $urls[] = ['loc' => $this->generateUrl('categories_career')];
        $urls[] = ['loc' => $this->generateUrl('categories_eq')];
        $urls[] = ['loc' => $this->generateUrl('categories_game')];
        $urls[] = ['loc' => $this->generateUrl('categories_health')];
        $urls[] = ['loc' => $this->generateUrl('categories_knowledge')];
        $urls[] = ['loc' => $this->generateUrl('categories_language')];
        $urls[] = ['loc' => $this->generateUrl('categories_movie')];
        $urls[] = ['loc' => $this->generateUrl('categories_music')];
        $urls[] = ['loc' => $this->generateUrl('categories_purity')];
        $urls[] = ['loc' => $this->generateUrl('categories_sport')];
        $urls[] = ['loc' => $this->generateUrl('categories_think')];
        $urls[] = ['loc' => $this->generateUrl('categories_tv')];
        $urls[] = ['loc' => $this->generateUrl('categories_youtube')];

        // add dynamic urls, like blog posts from your DB
        foreach ($em->getRepository(TestItem::class)->findAll() as $test) {
            $urls[] = [
                'loc' => $this->generateUrl('test_pass', ['name' => $test->getUrlName()])
            ];
        }

        $response = new Response(
            $this->renderView('others/sitemap.html.twig', array( 'urls' => $urls,
                'hostname' => $hostname)),
            200
        );
        $response->headers->set('Content-Type', 'xml');

        return $response;

    }
}
