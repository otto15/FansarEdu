<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klondike", name="klondike")
 */
class KlondikeController extends AbstractController
{
    /**
     * @Route("/", name="klondike")
     */
    public function index()
    {
        return $this->render('klondike/index.html.twig', [

        ]);
    }

    /**
     * @Route("/productAdding", name="productAdd")
     */
    public function productAdding() {

        return $this->RedirectToRoute('klondike');
    }
}

