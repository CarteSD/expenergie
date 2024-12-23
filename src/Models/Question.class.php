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
    private $id;
    private $title;
    private $answer;

    public function __construct($id, $question, $answer) {
        $this->id = $id;
        $this->title = $question;
        $this->answer = $answer;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }
}
