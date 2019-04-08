<?php

namespace App\Controller;

use App\Entity\AnswerChoice;
use App\Entity\Answer;
use App\Entity\Lesson;
use App\Entity\Post;
use App\Entity\Question;
use App\Entity\Subject;
use App\Entity\Term;
use App\Repository\SubjectRepository;
use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LessonAddingController extends AbstractController
{
    /**
     * @Route("/createLesson", name="createLesson")
     */
    public function createLesson()
    {
        $entity_manager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Subject::class);

        $lesson = new Lesson();

        $lesson->setTopic($_POST['topic']);
        $lesson->setVideolink($_POST['videolink']);
        $lesson->setLessonDescription($_POST['main_description']);
        $lesson->setShortDescription($_POST['short_description']);

        $sub = $repository->find($_POST['sub_choice']);

        $lesson->setSubject($sub);
        date_default_timezone_set('Europe/Moscow');
        $lesson->setCreatedDate(date('d-m-Y, h:i:s', time()));

        $entity_manager->persist($lesson);
        $entity_manager->flush();

        for ($i = 0; $i < count($_POST['term']); $i++) {
            $term = new Term();
            $term->setTerm($_POST['term'][$i]);
            $term->setDefinition($_POST['def'][$i]);
            $term->setLesson($lesson);

            $entity_manager->persist($term);
            $entity_manager->flush();
        }

        foreach ($_POST['quest'] as $k => $quest) {
            $question = new Question();
            $question->setQuestion($quest);
            $question->setLesson($lesson);

            $entity_manager->persist($question);
            $entity_manager->flush();

            foreach($_POST["answers".$k] as $key => $answer) {
                $answerObj = new Answer();
                $answerObj->setQuestion($question);
                $answerObj->setText($answer);
                $correct_ans = $_POST["isCorrect".$k];
                $isCor = 0;
                if ($key == $correct_ans) {
                    $isCor = 1;
                }
                $answerObj->setIsCorrect($isCor);
                $entity_manager->persist($answerObj);
                $entity_manager->flush();
            }
        }

        return $this->redirectToRoute('education');
    }

    /**
     * @Route("/lessonAdding", name="lessonAdding")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Subject::class);
        $subject_array = $repository->findAll();
        return $this->render('lesson_adding/index.html.twig', [
            'controller_name' => 'LessonAddingController',
            'sub_array' => $subject_array,
        ]);
    }

    /**
     * @Route("/createLesson1", name="createLesson1")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request) {
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, ['widget' => 'vlone',])
            ->add('text', TextAreaType::class)
            ->add('save', SubmitType::class, ['label' => 'послать',])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $post->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
        }

        return $this->render('lesson_adding/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * $Route("/createLesson1", name="createLesson2")
     * $param Request $request
     * @return Response
     */
    public function createLessonAction(Request $request) {
        $lesson = new Lesson();
        $question = new Question();

        $form = $this->createFormBuilder($lesson, $question)
            ->add('');
    }
}
