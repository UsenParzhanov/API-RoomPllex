<?php
/**
 * User: Nurbakit
 * Date: 03-Aug-16
 * Time: 8:23 PM
 */

class Database{

  private $_db;
  private $_configs;

  /**
   * Database constructor.
   */
  function __construct(){
    $this->_configs = $GLOBALS['configs']['database'];
    $pdo = new PDO("mysql:host={$this->_configs['host']}; dbname={$this->_configs['dbName']}; charset={$this->_configs['charset']}", $this->_configs['userName'], $this->_configs['userPass']);
    $this->_db = $pdo;
  }
  function __destruct(){
    $this->_db = null;
  }

  /**
   * example
   * * $db = new Database();
   * * $sel = $db->select('tableName', '*', 'WHERE id=? OR name=? LIMIT 1', array(1, 'Nurba'));
   * *
   * @param $table
   * @param $what
   * @param null $as
   * @param array $value
   * @return array
   */
  public function select($table, $what, $as = null, $value = array()){
    $sql = "SELECT {$what} FROM {$this->_configs['prefix']}{$table} {$as}";
    $stmt = $this->_db->prepare($sql);
    $check = $stmt->execute($value);
    $returnArr = array();
    $returnArr['check'] = $check == 1 ? $check : 0;
    $returnArr['count'] = $stmt->rowCount();
    $returnArr['assoc'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $returnArr;
  }

  /**
   * example
   * * $db = new Database();
   * * $ins = $db->insert('tableName', array('name' => 'Nurba', 'password' => 'Nurba password'));
   * *
   * @param $table
   * @param $value
   * @return bool|int
   */
  public function insert($table, $value){
    $valueKeys = array_keys($value);
    $valueValues = array_values($value);
    $count = sizeof($valueKeys);
    $x = 1;
    $what = null;
    $param = null;
    for($i = 0; $i < $count; $i++){
      $what .= "{$valueKeys[$i]}";
      $param .= '?';
      if($x < $count){
        $what .= ',';
        $param .= ',';
        ++$x;
      }
    }
    $sql = "INSERT INTO {$this->_configs['prefix']}{$table}({$what}) VALUES({$param})";
    $stmt = $this->_db->prepare($sql);
    $check = $stmt->execute($valueValues);
    return $check == 1 ? $check : 0;
  }

  /**
   * example
   * * $db = new Database();
   * * $up = $db->update('tableName', array('name' => 'Change', 'password' => 'Change password'), 'WHERE id=? AND email=?', array(1, 'test@mail.mail'));
   * *
   * @param $table
   * @param $what
   * @param $as
   * @param $asValue
   * @return bool|int
   */
  public function update($table, $what, $as, $asValue){
    $whatKeys = array_keys($what);
    $whatValues = array_values($what);
    $whatKeysCount = sizeof($whatKeys);
    $what = null;
    $x = 1;
    for($i = 0; $i < $whatKeysCount; $i++){
      $what .= "{$whatKeys[$i]}=?";
      if($x < $whatKeysCount){
        $what .= ',';
        ++$x;
      }
    }
    $asValueCount = sizeof($asValue);
    for($i = 0; $i < $asValueCount; $i++){
      $whatValues[] = $asValue[$i];
    }
    $sql = "UPDATE {$this->_configs['prefix']}{$table} SET {$what} {$as}";
    $stmt = $this->_db->prepare($sql);
    $check = $stmt->execute($whatValues);
    return $check == 1 ? $check : 0;
  }

  /**
   * example
   * * $db = new Database();
   * * $db->delete('tableName', 'WHERE id=?', array(1));
   * *
   * @param $table
   * @param $as
   * @param $value
   * @return bool|int
   */
  public function delete($table, $as, $value){
    $sql = "DELETE FROM {$this->_configs['prefix']}{$table} {$as}";
    $stmt = $this->_db->prepare($sql);
    $check = $stmt->execute($value);
    return $check == 1 ? $check : 0;
  }
}