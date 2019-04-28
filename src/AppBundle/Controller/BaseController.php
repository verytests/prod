<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    protected $connection;

    public function __construct(EntityManagerInterface $em)
    {
        $this->connection = $em;
    }

    public function successResponse($data = [], $status = "success")
    {
        $response = [
            'status' => $status,
            'data' => $data
        ];

        return new JsonResponse($response);
    }

    public function errorResponse($errors = [], $status = "error")
    {
        $response = [
            'status' => $status,
            'errors' => $errors
        ];

        return new JsonResponse($response) ;
    }
}
