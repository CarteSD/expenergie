<?php
/**
 * @file     Question.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

class Question {
    private ?int $id;
    private ?string $title;
    private ?string $answer;

    public function __construct(?int $id = null, ?string $question = null, ?string $answer = null) {
        $this->id = $id;
        $this->title = $question;
        $this->answer = $answer;
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getTitle() : ?string {
        return $this->title;
    }

    public function getAnswer() : ?string {
        return $this->answer;
    }

    public function setId(?int $id) : void {
        $this->id = $id;
    }

    public function setTitle(?string $title) : void {
        $this->title = $title;
    }

    public function setAnswer(?string $answer) : void {
        $this->answer = $answer;
    }
}
