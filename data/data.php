<?php
header('Access-Control-Allow-Origin:*');
//header("Content-type: application/json; charset=utf-8");

include 'spreadsheet.php';
$Spreadsheet = new Spreadsheet();
$Spreadsheet->authenticate("mindblitz1@gmail.com", "mindblitz1234");

$Spreadsheet->setSpreadsheetId("1wSS3zNudA6pzKk2OGAQhp62xmUqiLmYlXundf9GPWl8");
$Spreadsheet->setWorksheetId("od6");

//$Spreadsheet->add(array("header 2" => "aa22", "Header 1" => "bbb34"));
//$Spreadsheet->add((object)array("head er2" => "123", "header 1" => "345"));

//print_r($Spreadsheet->getColumnIDs());
//print_r($Spreadsheet->getAllData());

//print_r($Spreadsheet->getAllData()[$Spreadsheet->searchCol("hea der 2" ,"fdfdfdfdf")]);

//$Spreadsheet->delete("cokwr");



if (!isset($_GET['type'])){
    header('HTTP/1.0 404 Not Found');
	echo "error - no type";
	exit;
}

$data=json_decode(file_get_contents('php://input'));

switch ($_GET['type']) {
	case "set":
		echo json_encode(set($data));
		break;	
	case "get":
		echo json_encode(get($data->key));
		break;
	default:
		header('HTTP/1.0 404 Not Found');
		echo "error - not valid type";
		exit;
}



function set($data){
	global $Spreadsheet;
	if (!(isset($data->key) && $data->key!=null)){
		if (isset($data->facebookid) && $data->facebookid!=null)
			$data->key=$data->facebookid;
		else
			$data->key=sha1( microtime());
	}
	
	$rowId=$Spreadsheet->searchCol("key" ,$data->key);
	if ($rowId)
		$Spreadsheet->delete($rowId);	
	
	$Spreadsheet->add($data);
	
	return (object)array("key" =>$data->key);
}

function get($key){
	global $Spreadsheet;
	$rowId=$Spreadsheet->searchCol("key" ,$key);
	if ($rowId)
		return $Spreadsheet->getAllData()[$rowId];
	return null;
}

?>