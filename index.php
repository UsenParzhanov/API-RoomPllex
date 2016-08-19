<?php
/**
 * User: Nurbakit
 * Date: 03-Aug-16
 * Time: 7:47 AM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('engine/configs.php');

spl_autoload_register(function($class){
  require_once("engine/classes/{$class}.php");
});

require_once('engine/functions.php');

runApi();