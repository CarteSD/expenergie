<?php
/**
 * @file     ControllerAbout.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerAbout extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showAboutPage() {
        echo $this->getTwig()->render('about.twig');
    }
}