<?php

class accounts extends collection {
    protected static $modelName = 'account';

     static public function getAccountsById() {
       $db = dbConnection::getConnection();
       $tableName = get_called_class();
       $sql = 'SELECT * FROM ' . $tableName  . " where id < 6";
       $statement = $db->prepare($sql);
       $statement->execute();
       $class = static::$modelName;
       $statement->setFetchMode(PDO::FETCH_CLASS, $class);
       return  $statement->fetchAll();
     }

      static public function getCountById() {
        $db = dbConnection::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT count(*) as count FROM ' . $tableName  . " where id < 6";
	$statement = $db->prepare($sql);
        $statement->execute();
	return $statement->fetchColumn();
      }
}
