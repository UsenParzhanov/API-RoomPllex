<?php
/**
 * User: Nurbakit
 * Date: 03-Aug-16
 * Time: 7:47 AM
 */

$objURL = new Url();
$objResponse = new Response();
$objHelp = new Help();
// $objResponse->success($objHelp->get['signUp']);

function signUp(){
  global $objResponse, $objURL;

  $objURL->checkMoreParamAndIssetParam('email, password, againPassword', 'Регистрация');
  if($objURL->getURL[2] !== $objURL->getURL[3]) $objResponse->error('Пароли не совподает', 'Регистрация');
}

function getURL(){
  global $objResponse, $objURL;
  $arrURL = array();
  for($i = 0; $i < $objURL->getCountURL; $i++) $arrURL += array(($i+1) => $objURL->getURL[$i]);
  $objResponse->success(array('url' => $arrURL));
}

$objURL->funcRunURL();



// if(!$objURL->checkIsEqualRunURL($objURL->getCountURL-1, 'getURL')){
//   if    ($objURL->checkIsEqualRunURL(0, 'signUp'));
//   else  $objResponse->error('Не найдена имя функция');
// }