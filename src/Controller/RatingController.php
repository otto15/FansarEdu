<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rating", name="rating")
 */
class RatingController extends AbstractController
{
    /**
     * @Route("/", name="rating")
     */
    public function index()
    {
        return $this->render('rating/index.html.twig', [
            'controller_name' => 'RatingController',
        ]);
    }
}
