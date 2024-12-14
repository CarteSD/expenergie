<?php

namespace Controllers;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    /**
     * @brief Le loader de Twig
     * @var FilesystemLoader
     */
    private FilesystemLoader $loader;

    /**
     * @brief L'environnement de Twig
     * @var Environment
     */

    private Environment $twig;

    private ?array $get = null;

    private ?array $post = null;

    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;

        if (!empty($_GET)) {
            $this->get = $_GET;
        }

        if (!empty($_POST)) {
            $this->post = $_POST;
        }
    }

    public function call(string $method, ?array $args = []): mixed
    {
        if (!method_exists($this, $method)) {
            throw new Exception('La méthode ' . $method . ' n\'existe pas dans le contrôleur ' . get_class($this));
        }
        try {
            return $this->{$method}(...array_values($args));
        } catch (Exception $e) {
            echo $e->getCode() . " : " . $e->getMessage();
        }
    }

    /**
     * @brief Retourne l'attribut loader, correspondant au loader de Twig
     * @return FilesystemLoader Object retourné par la méthode, ici un FilesystemLoader représentant le loader de Twig
     */
    public function getLoader(): FilesystemLoader
    {
        return $this->loader;
    }

    /**
     * @brief Modifie l'attribut loader, correspondant au loader de Twig
     * @param FilesystemLoader $loader Le nouveau loader de Twig
     * @return void
     */
    public function setLoader(FilesystemLoader $loader): void
    {
        $this->loader = $loader;
    }

    /**
     * @brief Retourne l'attribut twig, correspondant à l'environnement de Twig
     * @return Environment Objet retourné par la méthode, ici un Environment représentant l'environnement de Twig
     */
    public function getTwig(): Environment
    {
        return $this->twig;
    }

    /**
     * @brief Modifie l'attribut twig, correspondant à l'environnement de Twig
     * @param Environment $twig Le nouvel environnement de Twig
     * @return void
     */
    public function setTwig(Environment $twig): void
    {
        $this->twig = $twig;
    }

    /**
     * @brief Retourne l'attribut GET, correspondant aux données passées en paramètre via la méthode GET
     * @return array|null Objet retourné par la méthode, ici un tableau associatif représentant les données passées en paramètre via la méthode GET
     */
    public function getGet(): ?array
    {
        return $this->get;
    }

    /**
     * @brief Modifie l'attribut GET, correspondant aux données passées en paramètre via la méthode GET
     * @param array|null $get Le nouveau tableau associatif représentant les données passées en paramètre via la méthode GET
     * @return void
     */
    public function setGet(?array $get): void
    {
        $this->get = $get;
    }

    /**
     * @brief Retourne l'attribut POST, correspondant aux données passées en paramètre via la méthode POST
     * @return array|null Objet retourné par la méthode, ici un tableau associatif représentant les données passées en paramètre via la méthode POST
     */
    public function getPost(): ?array
    {
        return $this->post;
    }

    /**
     * @brief Modifie l'attribut POST, correspondant aux données passées en paramètre via la méthode POST
     * @param array|null $post Le nouveau tableau associatif représentant les données passées en paramètre via la méthode POST
     * @return void
     */
    public function setPost(?array $post): void
    {
        $this->post = $post;
    }
}