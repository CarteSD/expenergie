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
}