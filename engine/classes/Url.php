<?php

/**
 * Created by PhpStorm.
 * User: Nurbakit
 * Date: 18-Aug-16
 * Time: 1:34 PM
 */
class Url{
  public $getURL;
  public $getCountURL;
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

    $this->getURL = $url;
    $this->getCountURL = sizeof($url);
    $this->_objResponse = new Response();
    $this->_objHelp = new Help();
  }

  /**
   * @param $index
   * @param $urlName
   * @return bool
   */
  public function checkIsEqualRunURL($index, $urlName){
    $isEqual = $this->getURL[$index] === $urlName;
    if($isEqual) $urlName();
    return $isEqual ? true : false;
  }

  public function funcRunURL(){
    if($this->getURL[$this->getCountURL-1] === 'getURL') getURL();
    elseif($this->getURL[0] === 'getHelp') {$this->_objResponse->success($this->_objHelp->get);}
    elseif($this->getURL[1] === 'getHelp') $this->_objResponse->success($this->_objHelp->get[$this->getURL[1]]);
    elseif(isset($this->_objHelp->getHelp[$this->getURL[0]])) $this->getURL[0]();
    else $this->_objResponse->error('Не возможно найти имя функция', 'Главный');
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

    $checkMore = $this->getCountURL > $numberMore;
    if($checkMore) $this->_objResponse->error("{$number} параметра должын быть [{$paramName}]", $funcName);

    for($i = 1; $i <= $number; $i++){
      $checkIsset = !isset($this->getURL[$i]);
      $paramName = trim($arrParamName[$i-1]);
      if($checkIsset) $this->_objResponse->error("Не найден [{$paramName}]", $funcName);
    }
  }
}