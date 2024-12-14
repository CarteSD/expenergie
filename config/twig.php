<?php
/**
 * @file     twig.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

use Twig\Extension\CoreExtension;
use Twig\Extension\DebugExtension;
use Twig\Extra\Intl\IntlExtension;

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../src/templates');
$twig = new Twig\Environment($loader, [
    'debug' => true,
]);

$twig->getExtension(CoreExtension::class)->setTimezone('Europe/Paris');
$twig->addExtension(new DebugExtension());
$twig->addExtension(new IntlExtension());