<?php
/**
 * @file     Controller.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

namespace Controllers;

use Db;
use Exception;
use PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private PDO $pdo;

    private FilesystemLoader $loader;

    private Environment $twig;

    private ?array $get = null;

    private ?array $post = null;

    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        $this->pdo = Db::getInstance()->getConnection();
        $this->loader = $loader;
        $this->twig = $twig;

        if (!empty($_GET)) {
            $this->get = $_GET;
        }

        if (!empty($_POST)) {
            $this->post = $_POST;
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function getLoader(): FilesystemLoader
    {
        return $this->loader;
    }

    public function setLoader(FilesystemLoader $loader): void
    {
        $this->loader = $loader;
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }

    public function setTwig(Environment $twig): void
    {
        $this->twig = $twig;
    }

    public function getGet(): ?array
    {
        return $this->get;
    }

    public function setGet(?array $get): void
    {
        $this->get = $get;
    }

    public function getPost(): ?array
    {
        return $this->post;
    }

    public function setPost(?array $post): void
    {
        $this->post = $post;
    }
}