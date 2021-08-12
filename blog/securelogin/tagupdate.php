<?php 
include "../common.php";
$action = $_POST['action']; 
$updateRecordsArray = $_POST['recordsArray'];
if ($action == "updateRecordsListings"){
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
$update = array(
   'corder' => $listingCounter
);
$where_clause = array(
    'cid' => $recordIDValue
);
$updated = $db->update( 'tags', $update, $where_clause, 1);
$listingCounter = $listingCounter + 1;	
}
}
?>