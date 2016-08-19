<?php

/**
 * Created by PhpStorm.
 * User: Nurbakit
 * Date: 18-Aug-16
 * Time: 2:20 PM
 */
class Response{
  /**
   * @param array $arr
   */
  protected function _jsonEncode($arr){
    exit(json_encode($arr));
  }

  /**
   * @param $errorDesc
   * @param bool $funcName
   */
  public function error($errorDesc, $funcName = false){
    $arr = array('error' => true, 'error-description' => $errorDesc);
    if($funcName) $arr += array('function-name' => $funcName);
    $this->_jsonEncode($arr);
  }

  /**
   * @param bool $successText
   */
  public function success($successText = false){
    $arr = array('success' => true);
    if($successText) $arr += $successText;
    $this->_jsonEncode($arr);
  }
}