<?php
//Test Connection
require_once("isdk.php");	
$app = new iSDK;

if($app->cfgCon("aa478"))
{


$contactid = $_REQUEST['contactId'];


//Fetch the data from the contact using the contact_idl
$returnFields = array('ContactNotes','Email',
						'_EmailMakeUpCode',
						'_MakeupEmailsubcode',
						'_MakeUpEmailStaffName',
						'_EmailHistoryEditDate',
						);
$conDat = $app->loadCon($contactid, $returnFields);
print_r($conDat);
$Email = $conDat['Email'];
$EmailMakeUpCode = $conDat['_EmailMakeUpCode'];
$MakeupEmailsubcode = $conDat['_MakeupEmailsubcode'];
$MakeUpEmailStaffName = $conDat['_MakeUpEmailStaffName'];
$EmailHistoryEditDate = $conDat['_EmailHistoryEditDate'];


//Get Contact Notes
$exist_data = $conDat['ContactNotes'];
// echo $exist_data;
	
	//Update the contact notes with the values of the custom fields that we get from the loadCon Query
	$grp = array(
		'ContactNotes' => $exist_data. PHP_EOL .$Email.'/'.$EmailMakeUpCode.$MakeupEmailsubcode.'('.$MakeUpEmailStaffName.'/'.$EmailHistoryEditDate.');'
	);
	$grpID = $app->dsUpdate("Contact", $contactid, $grp);  
	echo $grpID;
}
?>