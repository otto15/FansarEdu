<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LessonAddingController extends AbstractController
{
    /**
     * @Route("/lesson_adding", name="lesson_adding")
     */
    public function index()
    {
        return $this->render('lesson_adding/index.html.twig', [
            'controller_name' => 'LessonAddingController',
        ]);
    }
}
