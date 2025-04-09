<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './commons/env.php';
require_once './commons/function.php';

require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/UserController.php';
require_once './controllers/AuthController.php';

session_start();
require_once "config/database.php";

$database = new Database();
$db = $database->getConnection();

$act = isset($_GET['act']) ? $_GET['act'] : '';

$authController = new AuthController($db);

switch ($act) {
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        require_once 'views/home.php';
        break;
}