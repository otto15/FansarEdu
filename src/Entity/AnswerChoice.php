<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerChoiceRepository")
 */
class AnswerChoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correct_answer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wrong_ans1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorrectAnswer(): ?string
    {
        return $this->correct_answer;
    }

    public function setCorrectAnswer(string $correct_answer): self
    {
        $this->correct_answer = $correct_answer;

        return $this;
    }

    public function getWrongAns1(): ?string
    {
        return $this->wrong_ans1;
    }

    public function setWrongAns1(string $wrong_ans1): self
    {
        $this->wrong_ans1 = $wrong_ans1;

        return $this;
    }

    public function getWrongAns2(): ?string
    {
        return $this->wrong_ans2;
    }

    public function setWrongAns2(?string $wrong_ans2): self
    {
        $this->wrong_ans2 = $wrong_ans2;

        return $this;
    }

    public function getWrongAns3(): ?string
    {
        return $this->wrong_ans3;
    }

    public function setWrongAns3(?string $wrong_ans3): self
    {
        $this->wrong_ans3 = $wrong_ans3;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
