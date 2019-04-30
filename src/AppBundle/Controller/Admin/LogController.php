<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Log;
use AppBundle\Services\LogService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LogController
 * @package App\Controller\admin
 *
 * @Route("/admin", name="admin_")
 */
class LogController extends BaseController
{
    /**
     * @Route("/logs", name="logs", methods={"GET"})
     */
    public function indexAction(Request $request)
    {
        $options = [
            'level' => $request->query->get('level'),
            'source' => $request->query->get('source'),
            'section' => $request->query->get('section'),
            'date' => [
                'start' => $request->query->get('start_date'),
                'end' => $request->query->get('end_date')
            ]
        ];

        /** @var LogService $logService */
        $logService = $this->get('app.log');

        $query = $logService->getLogsByOptions($options);

        $paginator = $this->get('knp_paginator');

        $logs = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        $log = new Log();
        $levels = $log->getLevels();
        $sources = $log->getSources();
        $sections = $log->getSections();

        return $this->render('admin/logs/logs.html.twig', [
            'levels' => $levels,
            'sources' => $sources,
            'sections' => $sections,
            'logs' => $logs
        ]);
    }
}
