<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataBaseController extends AbstractController
{
    /**
     * @Route("/createSubject", name="createSubject")
     */
    public function createSubject()
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $subject = new Subject();
        $subject->setName($_POST['name']);

        $entity_manager->persist($subject);
        $entity_manager->flush();

        return new Response('Added new entity with id = '.$subject->getId().' and with name '.$subject->getName());

    }

    /**
     * @Route("/subjectForm", name="subjectForm")
     */
    public function createSubjectFrom()
    {
         return $this->render('data_base/sub_form.html.twig');
    }

    /**
     * @Route("/subject/{id}", name="get_subject")
     */
    public function getSubject($id)
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        return new Response($subject->getName());
    }
}
