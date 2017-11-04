<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//Constants
define('DATABASE', 'tp274');
define('USERNAME', 'tp274');
define('PASSWORD', 'trup@123');
define('CONNECTION', 'sql1.njit.edu');

#header('content-type: text/plain');
class dbConnection{

    //variable to hold connection object.
        protected static $db;
    //private construct - class cannot be instatiated externally.
        private function __construct() {
        try {
	// assign PDO object to db variable
         self::$db = new PDO( 'mysql:host=' . CONNECTION .';dbname=' . DATABASE, USERNAME, PASSWORD );
	 self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 echo "Connected successfull. </br>";
	     }
	 catch (PDOException $e) {
	//Output error - would normally log this to error file rather than output to user
	echo "Connection Error: " . $e->getMessage();
	}
    }
	// get connection function. Static method - accessible without instantiation
    	public static function getConnection() {
        //Guarantees single instance, if no connection object exists then create one.
        if (!self::$db) {
        //new connection object.
          new dbConnection();
           }
         //return connection.
         return self::$db;
        }
}

class collection {

	//this is a static method so you can load all the records
    	static public function findAll() {
    	//get the connection with the singleton
        $db = dbConnection::getConnection();
	//This sets the table for the query to the name of the static class being used to run find all
	$tableName = get_called_class();
	//this is making the select query using the name of the table
	$sql = 'SELECT * FROM ' . $tableName  . " where id < 6";
	//this loads the query into the statement object that will run the query
	$statement = $db->prepare($sql);
	//this runs the query
	$statement->execute();
	//this gets the name of the model from the child class that the static method was called from
	$class = static::$modelName;
	//this fetches the records as the class that is required for the record/table type
	$statement->setFetchMode(PDO::FETCH_CLASS, $class);
	//this loads the records into the record set
	$recordsSet =  $statement->fetchAll();
	//this returns the record set
	 return $recordsSet;
       }
 } 

class account {

	public $id;
	public $email;
	public $fname;
	public $lname;
	public $phone;
	public $birthday;
	public $gender;
	public $password;

}

class accounts extends collection {
    protected static $modelName = 'account';

    }

 
class CommonUtils {

	public static function getRecordCount($records){
          echo "The number of records : " .sizeof($records)."</br>" ;
        }

        //To display the result in html table format	
	public static function displayRecords($records){
	  $html = '<html><body><table border = 1>';
	  $html .= self :: tableHead($records);
	  $html .= self :: tableBody($records);
	  $html .= '</table></html>';
	  echo $html;
       }

	public static function tableHead($records) {
    	$html = '<thead>';
    	foreach ( $records as $account) {
          $html .= '<tr>';
    	  foreach ( $account as $key => $value ) {
	    $html .= '<th>' .  $key  . '</th>';
    	  }
          $html .= '</tr>';
          break;
        }
        $html .= '</thead>';
        return $html;
    }


	public static function tableBody($records) {
    	  $html = '<tbody>';
          foreach ( $records as $account) {
	    $html .= '<tr>';
	    foreach ( $account as $key => $value ) {
	      $html .= '<td>' .  $value  . '</td>';
	    }
	    $html .= '</tr>';
	  }
	  $html .= '</tbody>';
          return  $html;
   }


}
$records = accounts::findAll();
#print_r($records);
CommonUtils :: getRecordCount($records);
CommonUtils :: displayRecords($records);
