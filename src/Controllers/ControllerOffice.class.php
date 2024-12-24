<?php
/**
 * @file     ControllerOffice.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     24/12/2024
 * @version  1.0
 */

namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerOffice extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showLoginPage() {
        echo $this->getTwig()->render('login.twig');
    }
}