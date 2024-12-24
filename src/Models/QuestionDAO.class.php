<?php
/**
 * @file     QuestionDAO.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

class QuestionDAO
{
    private ?PDO $pdo;

    public function __construct(?PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function hydrate(?array $datas) : Question {
        return new Question($datas['id'], $datas['title'], $datas['answer'], $datas['link']);
    }

    public function hydrateMany(?array $datas) : array {
        $questions = [];
        foreach ($datas as $data) {
            $questions[] = $this->hydrate($data);
        }
        return $questions;
    }

    public function findAll() : array {
        $query = $this->pdo->prepare('SELECT * FROM ' . DB_PREFIX . 'faq');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $questions = $query->fetchAll();
        return $this->hydrateMany($questions);
    }

    public function delete($id) : bool
    {
        $query = $this->pdo->prepare('DELETE FROM ' . DB_PREFIX . 'faq WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }

    public function findById($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . DB_PREFIX . 'faq WHERE id = 11');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $question = $query->fetch();
        return $this->hydrate($question);
    }

    public function update(Question $question)
    {
        $query = $this->pdo->prepare('UPDATE ' . DB_PREFIX . 'faq SET title = :title, answer = :answer, link = :link WHERE id = :id');
        $id = $question->getId();
        $query->bindParam(':id', $id);
        $title = $question->getTitle();
        $query->bindParam(':title', $title);
        $answer = $question->getAnswer();
        $query->bindParam(':answer', $answer);
        $link = $question->getLink();
        $query->bindParam(':link', $link);
        return $query->execute();
    }
}