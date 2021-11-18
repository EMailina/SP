<?php
require "ClassLoader.php";
session_start();
use App\App;

$app = new App();
$app->run();