<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class UserController extends AbstractController
{
    /**
    * @Route("/", name="user_index", methods={"GET"})
    */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }
}