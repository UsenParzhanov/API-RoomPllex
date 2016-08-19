<?php

/**
 * Created by PhpStorm.
 * User: Nurbakit
 * Date: 19-Aug-16
 * Time: 12:58 PM
 */
class Help{
  public $getHelp;

  function __construct(){
    $this->getHelp = array(
      'getHelp' => array(
          'function-name' => 'Мини документация'
      ),

      'signUp' => array(
        'function-name' => 'Регистрация',
        'param' => array(
          'email' => 'Почта support@roompllex.com',
          'password' => 'Пароль должын быть больше 6 символ',
          'againPassword' => 'Подтверждение пароля'
        ),
        'example' => 'signUp/email/password/againPassword'
      ),

      'getUrl' => array(
        'function-name' => 'Обратно передает url',
      ),

    );
  }
}