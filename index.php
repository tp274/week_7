<?php
//turn on debugging messages
ini_set('display_errors', 'true');
error_reporting(E_ALL);

//instantiate the program object
//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {

    public static function autoload($class) {
                //you can put any file name or directory here
	include strtolower($class) . '.php';
	}			 	
}

spl_autoload_register(array('Manage', 'autoload'));

//include config file with db information

require('./phpconfig.php');

$records = Accounts::findAll();
CommonUtils :: getRecordCount($records);
CommonUtils :: displayRecords($records);
