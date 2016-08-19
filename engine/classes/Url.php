<?php

/**
 * Created by PhpStorm.
 * User: Nurbakit
 * Date: 18-Aug-16
 * Time: 1:34 PM
 */
class Url{
  public $getUrl;
  public $getCountUrl;
  protected $_objResponse;
  protected $_objHelp;

  /**
   * Url constructor.
   */
  function __construct(){
    $url = substr($_SERVER['REQUEST_URI'], 1);
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);

    $this->getUrl = $url;
    $this->getCountUrl = sizeof($url);
    $this->_objResponse = new Response();
    $this->_objHelp = new Help();
  }

  /**
   * Запуск урл
   */
  public function funcRunUrl(){
    if(!isset($this->_objHelp->getHelp[$this->getUrl[0]]) XOR $this->getUrl[0] === '') $this->_objResponse->error('Не возможно найти имя функция', 'Главный');
    elseif($this->getUrl[0] === '') $this->_objResponse->error('Запрос не должын быть пустым', 'Главный');
    elseif($this->getUrl[$this->getCountUrl-1] === 'getUrl') getUrl();
    elseif($checkSecondGetHelp = isset($this->getUrl[1]) ? $this->getUrl[1] === 'getHelp' : false) $this->_objResponse->success($this->_objHelp->getHelp[$this->getUrl[0]]);
    elseif($this->getUrl[0] === 'getHelp') $this->_objResponse->success($this->_objHelp->getHelp);
    else $this->getUrl[0]();
  }

  /**
   * @param $number
   * @param $paramName
   * @param $funcName
   */
  public function checkMoreParamAndIssetParam($paramName, $funcName){
    $arrParamName = explode(',', $paramName);
    $number = sizeof($arrParamName);
    $numberMore = $number + 1;

    $checkMore = $this->getCountUrl > $numberMore;
    if($checkMore) $this->_objResponse->error("{$number} параметра должын быть [{$paramName}]", $funcName);

    for($i = 1; $i <= $number; $i++){
      $checkIsset = !isset($this->getUrl[$i]);
      $paramName = trim($arrParamName[$i-1]);
      if($checkIsset) $this->_objResponse->error("Не найден [{$paramName}]", $funcName);
    }
  }
}