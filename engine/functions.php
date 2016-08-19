<?php
/**
 * Created by PhpStorm.
 * User: Nurbakit
 * Date: 19-Aug-16
 * Time: 9:47 PM
 */

function runApi(){
  $objUrl = new Url();
  $objUrl->funcRunUrl();
}

$objUrl = new Url();
$objResponse = new Response();
$objHelp = new Help();

function signUp(){
  global $objResponse, $objUrl;

  $objUrl->checkMoreParamAndIssetParam('email, password, againPassword', 'Регистрация');
  if($objUrl->getUrl[2] !== $objUrl->getUrl[3]) $objResponse->error('Пароли не совподает', 'Регистрация');
}

function getUrl(){
  global $objResponse, $objUrl;
  $arrUrl = array();
  for ($i = 0; $i < $objUrl->getCountUrl; $i++) $arrUrl += array(($i + 1) => $objUrl->getUrl[$i]);
  $objResponse->success(array('url' => $arrUrl));
}