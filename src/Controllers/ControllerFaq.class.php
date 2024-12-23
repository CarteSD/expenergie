<?php
/**
 * @file     ControllerFaq.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

namespace Controllers;

use QuestionDAO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerFaq extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showFaqPage() {
        $questionsManager = new QuestionDAO($this->getPdo());
        $questions = $questionsManager->findAll();
        echo $this->getTwig()->render('faq.twig', [
            "questions" => $questions,
        ]);
    }
}