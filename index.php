<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/src/Request.php';
require_once __DIR__ . '/src/RandomGenerator.php';
require_once __DIR__ . '/src/Renderer.php';
require_once __DIR__ . '/src/App.php';

use App\Src\Request;
use App\Src\Renderer;
use App\Src\App;

$request = new Request($_GET, $_POST);
$renderer = new Renderer();
$app = new App($request, $renderer);
$app->run();
