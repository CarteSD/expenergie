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
        return new Question($datas['id'], $datas['title'], $datas['answer']);
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
}