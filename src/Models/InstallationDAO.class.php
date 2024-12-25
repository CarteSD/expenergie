<?php
/**
 * @file     InstallationDAO.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

class InstallationDAO
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

    public function hydrate(?array $datas) : Installation {
        return new Installation($datas['id'], $datas['title'], $datas['description'], $datas['details'], $datas['imgPath']);
    }

    public function hydrateMany(?array $datas) : array {
        $questions = [];
        foreach ($datas as $data) {
            $questions[] = $this->hydrate($data);
        }
        return $questions;
    }

    public function findAll() : array {
        $query = $this->pdo->prepare('SELECT * FROM ' . DB_PREFIX . 'installation');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $installations = $query->fetchAll();
        return $this->hydrateMany($installations);
    }

    public function delete($id)
    {
        $query = $this->pdo->prepare('DELETE FROM ' . DB_PREFIX . 'installation WHERE id = :id');
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}