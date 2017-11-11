<?php
 class AccountRenderer {

         //To display the no. of records
	public static function getRecordCount($records){
           echo "The number of records : " .sizeof($records)."</br>" ;
         }

	public static function displayRecords($records){
           $html = '<html><body><table border = 1>';
	   $html .= self :: tableHead($records);
	   $html .= self :: tableBody($records);
	   $html .= '</table></html>';
	   echo $html;
	}

	// generate table header
        public static function tableHead($records) {
	  $html = '<thead>';
	  $html .= '<tr>';
	  foreach ( $records[0] as $key => $value ) {
	    $html .= '<th>' .  $key  . '</th>';
	    }
	  $html .= '</tr>';
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
	   return $html;
	}
	
}

