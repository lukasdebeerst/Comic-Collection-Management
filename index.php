<?php

session_start();
$_SESSION['id'] = $sessionId = session_regenerate_id();
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Brussels');
header('Cache-Control: max-age=900');

if(empty($_SESSION['currentUser'])){
  unset($_SESSION['currentUser']);
}

if (!empty($_SESSION['info'])) {
  unset($_SESSION['info']);
}
if (!empty($_SESSION['error'])) {
  unset($_SESSION['error']);
}
if (!empty($_SESSION['passwordError'])) {
  unset($_SESSION['passwordError']);
}
if (!empty($_SESSION['test'])) {
  unset($_SESSION['test']);
}
if (!empty($_SESSION['message'])) {
  unset($_SESSION['message']);
}
if (!empty($_SESSION['succes'])) {
  unset($_SESSION['succes']);
}


$routes = array(
  'home' => array(
      'controller' => 'Authentication',
      'action' => 'index'
  ),
  'homeScreen' => array(
    'controller' => 'Pages',
    'action' => 'index'
  ),
  'search' => array(
    'controller' => 'Pages',
    'action' => 'search'
  ),
  'advancedSearch' => array(
    'controller' => 'Pages',
    'action' => 'advancedSearch'
  ),
  'results' => array(
    'controller' => 'Pages',
    'action' => 'results'
  ),
  'admin' => array(
    'controller' => 'Admin',
    'action' => 'admin'
  ),
  'adminUpload' => array(
    'controller' => 'Admin',
    'action' => 'adminUpload'
  ),
  'users' => array(
    'controller' => 'Admin',
    'action' => 'users'
  ),
  'addItems' => array(
    'controller' => 'Pages',
    'action' => 'addItems'
  ),
  'instellingen' => array(
    'controller' => 'Pages',
    'action' => 'instellingen'
  ),
  'updateItem' => array(
    'controller' => 'Pages',
    'action' => 'updateItem'
  ),
  'export' => array(
    'controller' => 'Pages',
    'action' => 'export'
  ),
  'deleteItem' => array(
    'controller' => 'Pages',
    'action' => 'deleteItem'
  ),
  'deleteBulk' => array(
    'controller' => 'Admin',
    'action' => 'deleteBulk'
  ),
  'deleteUser' => array(
    'controller' => 'Admin',
    'action' => 'deleteUser'
  ),
  'addEmptyItem' => array(
    'controller' => 'Pages',
    'action' => 'addEmptyItem'
  ),
  'addItemDelete' => array(
    'controller' => 'Pages',
    'action' => 'addItemDelete'
  ),

  //pdf files
  'Catalogus' => array(
    'controller' => 'Export',
    'action' => 'Catalogus'
  ),
);

if (empty($_GET['page'])) {
  $_GET['page'] = 'home';
}
if (empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once __DIR__ . '/controller/' . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();
