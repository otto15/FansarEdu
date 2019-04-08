<?php

namespace App\Controller;

use App\Entity\AnswerChoice;
use App\Entity\Answer;
use App\Entity\Lesson;
use App\Entity\Question;
use App\Entity\Subject;
use App\Entity\Term;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;



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
        $repository = $this->getDoctrine()->getRepository(Lesson::class);
        $sub_repository = $this->getDoctrine()->getRepository(Subject::class);
        $lesson_array = $repository->findBy(['subject' => 1]);
        $subject_array = $sub_repository->findAll();
        return $this->render('education/index.html.twig', [
            'controller_name' => 'EducationController',
            'lesson_array' => $lesson_array,
            'sub_array' => $subject_array,
        ]);
    }

    /**
     * @Route("/education/lessons/{id}", name="getLesson")
     */
    public function postAction($id)
    {
        $repository_answer = $this->getDoctrine()->getRepository(AnswerChoice::class);
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->find($id);
        $terms = $lesson->getTerms();
        $quests = $lesson->getQuestions();

        return $this->render('education/lesson.html.twig',[
            'topic' => $lesson->getTopic(),
            'lessonDescription' => $lesson->getLessonDescription(),
            'videolink' => $lesson->getVideolink(),
            'terms' => $terms,
            'questions' => $quests,
            'lessonId' => $lesson->getId(),
        ]);
    }

    /**
 * @Route("education/{id}/lessons", name="lessonsBySubject")
 */
    public function lessonsBySubject($id)
    {
        $lesson_repository = $this->getDoctrine()->getRepository(Lesson::class);
        $sub_repository = $this->getDoctrine()->getRepository(Subject::class);

        $lesson_array = $lesson_repository->findBy(['subject' => $id]);
        $subject_array = $sub_repository->findAll();
        return $this->render('education/index.html.twig', [
            'controller_name' => 'EducationController',
            'lesson_array' => $lesson_array,
            'sub_array' => $subject_array,
        ]);
    }

    /**
     * @Route("/education/lessons/{id}/delete", name="deleteLesson")
     */
    public function deleteLessonAction($id)
    {
        $entity_manager = $this->getDoctrine()->getManager();

        $repository_lesson = $this->getDoctrine()->getRepository(Lesson::class);
        $repository_quest = $this->getDoctrine()->getRepository(Question::class);
        $repository_ans = $this->getDoctrine()->getRepository(AnswerChoice::class);

        $lesson = $repository_lesson->find($id);
        $questions = $repository_quest->findBy(['lesson' => $id]);

        foreach ($questions as $single_quest) {
            $answers = $repository_ans->findBy(['question' => $single_quest->getId()]);
            foreach ($answers as $single_answer) {
                $entity_manager->remove($single_answer);
            }
            $entity_manager->remove($single_quest);
        }

        $entity_manager->remove($lesson);
        $entity_manager->flush();

        return $this->redirectToRoute('education');
    }

    /**
     * @Route("/education/lessons/{id}/edit", name="editLesson")
     */
    public function editLesson($id) {
        $repository = $this->getDoctrine()->getRepository(Subject::class);
        $repository_lesson = $this->getDoctrine()->getRepository(Lesson::class);
        $repository_quest = $this->getDoctrine()->getRepository(Question::class);
        $repository_terms = $this->getDoctrine()->getRepository(Term::class);
        $repository_ans = $this->getDoctrine()->getRepository(AnswerChoice::class);
        $lesson = $repository_lesson->find($id);
        $terms = $repository_terms->findBy(['lesson' => $id]);
        $subject_array = $repository->findAll();
        $quests = $repository_quest->findBy(['lesson' => $id]);
        $answers = array();
        $i = 0;
        foreach ($quests as $quest) {
            $ans = $repository_ans->findOneBy(['question' => $quest->getId(),]);
            array_push($answers, array($i, $ans));
            $i++;
        }
        return $this->render('education/lessonEditing.html.twig', [
            'sub_array' => $subject_array,
            'short_description' => $lesson->getShortDescription(),
            'main_description' => $lesson->getLessonDescription(),
            'sub_id' => $lesson->getSubject()->getId(),
            'videolink' => $lesson->getVideolink(),
            'topic' => $lesson->getTopic(),
            'terms' => $terms,
            'switcher' => $terms[0]->getId(),
            'answers' => $answers,
            'quests' => $quests,
            'lesson_id' => $id,
        ]);
    }

    /**
     * @Route("/education/lessons/{id}/editLessonAction", name="editAction")
     */
    public function editLessonAction($id) {
        $entity_manager = $this->getDoctrine()->getManager();
        $repository_lesson = $this->getDoctrine()->getRepository(Lesson::class);
        $repository_subject = $this->getDoctrine()->getRepository(Subject::class);
        $repository_quest = $this->getDoctrine()->getRepository(Question::class);
        $repository_terms = $this->getDoctrine()->getRepository(Term::class);
        $repository_ans = $this->getDoctrine()->getRepository(AnswerChoice::class);
        $lesson = $repository_lesson->find($id);

        $lesson->setTopic($_POST['topic']);
        $lesson->setVideolink($_POST['videolink']);
        $lesson->setLessonDescription($_POST['main_description']);
        $lesson->setShortDescription($_POST['short_description']);

        $sub = $repository_subject->find($_POST['sub_choice']);

        $lesson->setSubject($sub);
        $entity_manager->flush();

        $entity_manager->persist($lesson);
        for ($i = 0; $i < count($_POST['term']); $i++) {
            $term = $repository_terms->find($_POST['term_id'][$i]);
            $term->setTerm($_POST['term'][$i]);
            $term->setDefinition($_POST['def'][$i]);

            $entity_manager->persist($term);
            $entity_manager->flush();
        }

        $i = 0;
        foreach ($_POST['quest'] as $quest) {
            $question = $repository_quest->find($_POST['quest_id'][$i]);
            $question->setQuestion($quest);

            $entity_manager->persist($question);

            $entity_manager->flush();

            $answer = $repository_ans->findOneBy(['question' => $question->getId(),]);
            $answer->setQuestion($question);
            $answer->setCorrectAnswer($_POST['correct_answer'][$i]);
            $answer->setWrongAns1($_POST['wrong_answer_' . $i][0]);
            $answer->setWrongAns2($_POST['wrong_answer_' . $i][1]);
            $answer->setWrongAns3($_POST['wrong_answer_' . $i][2]);


            $entity_manager->persist($answer);
            $entity_manager->flush();
            $i++;
        }
        return $this->redirectToRoute('education');
    }

    /**
     * @Route("/education/lessons/{id}/check", name="answerChecking")
     */
    public function checkAction($id) {
        $repository_answer = $this->getDoctrine()->getRepository(Answer::class);
        $repository_quest = $this->getDoctrine()->getRepository(Question::class);
        $questions = $repository_quest->findBy(['lesson' => $id]);
        $cor_ans_count = 0;
        foreach ($questions as $quest) {
            $answer_id = $_POST['answer'.$quest->getId()];
            $answer = $repository_answer->find($answer_id);
            if ($answer->getIsCorrect() == 1) {
                $cor_ans_count = $cor_ans_count + 1;
            }
        }
        if ($cor_ans_count == count($questions)) {
            return new Response('yeah');
        }else {
            return new Response('ouh');
        }
    }
}
