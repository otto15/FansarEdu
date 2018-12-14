<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class EducationController extends AbstractController
{
    /**
     * @Route("/", name="education")
     */
    public function redirectAction()
    {
        return $this->redirectToRoute('education');
    }
    /**
     * @Route("/education", name="education")
     */
    public function indexAction()
    {
        return $this->render('education/index.html.twig', [
            'controller_name' => 'EducationController',
        ]);
    }
    /**
     * @Route("/education/lesson", name="lesson")
     */
    public function postAction()
    {
        return $this->render('education/lesson.html.twig',[

        ]);
    }
}
