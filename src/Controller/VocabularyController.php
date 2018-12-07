<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vocabulary", name="vocabulary")
 */
class VocabularyController extends AbstractController
{
    /**
     * @Route("/", name="vocabulary")
     */
    public function index()
    {
        return $this->render('vocabulary/index.html.twig', [
            'controller_name' => 'VocabularyController',
        ]);
    }
}
