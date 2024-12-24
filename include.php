<?php
/**
 * @file     include.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/config/const.php';
require_once __DIR__ . '/config/twig.php';
require_once __DIR__ . '/config/db.php';

require_once __DIR__ . '/src/Models/Router.class.php';
require_once __DIR__ . '/src/Models/Db.class.php';
require_once __DIR__ . '/src/Models/Question.class.php';
require_once __DIR__ . '/src/Models/QuestionDAO.class.php';
require_once __DIR__ . '/src/Models/Installation.class.php';
require_once __DIR__ . '/src/Models/InstallationDAO.class.php';

require_once __DIR__ . '/src/Controllers/Controller.class.php';
require_once __DIR__ . '/src/Controllers/ControllerFactory.class.php';
require_once __DIR__ . '/src/Controllers/ControllerHome.class.php';
require_once __DIR__ . '/src/Controllers/ControllerOffres.class.php';
require_once __DIR__ . '/src/Controllers/ControllerServices.class.php';
require_once __DIR__ . '/src/Controllers/ControllerAbout.class.php';
require_once __DIR__ . '/src/Controllers/ControllerFaq.class.php';
require_once __DIR__ . '/src/Controllers/ControllerContact.class.php';
require_once __DIR__ . '/src/Controllers/ControllerInstallation.class.php';
require_once __DIR__ . '/src/Controllers/ControllerOffice.class.php';