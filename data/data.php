<?php
header('Access-Control-Allow-Origin:*');
header("Content-type: application/json; charset=utf-8");

require_once("db.php");
require_once('shareimage.php');


$dbhost='localhost';
$dbName="mindblitz";
$dbUserName="root";
$dbPass="";
/**/

$csvCode="abc555";

$db = new Db($dbhost,$dbName,$dbUserName,$dbPass,"dbError.log");



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
	case "getAvrage":
		echo json_encode(getAvrage());
		break;
	case "csv":
		if ($_GET['code']==$csvCode){
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=data.csv');
			printCSV();
		}
		break;
	default:
		header('HTTP/1.0 404 Not Found');
		echo "error - not valid type";
		exit;
}



function set($data){
	global $db;
	if (!(isset($data->key) && $data->key!=null)){
		if (isset($data->facebookId) && $data->facebookId!=null)
			$data->key=$data->facebookId;
		else
			$data->key=sha1( microtime());
	} 
	
	$result = $db->smartQuery(array(
		'sql' => "INSERT INTO data (`key`, `facebookID`, `name`, `age`, `gender`, `profession`, `study`, `email`, `visualTextual`, `independentSocial`, `bouncyLinear`, `activePassive`, `autodidacticFramed`, `gamesSerious`, `subjectInterdisciplinary`) ".
								"VALUES (:key, :facebookID, :name, :age, :gender, :profession, :study, :email, :visualTextual, :independentSocial, :bouncyLinear, :activePassive, :autodidacticFramed, :gamesSerious, :subjectInterdisciplinary) ".
					"ON DUPLICATE KEY UPDATE `key`=:key,facebookID=:facebookID, name=:name,age=:age,gender=:gender,profession=:profession,study=:study,email=:email,visualTextual=:visualTextual,independentSocial=:independentSocial,bouncyLinear=:bouncyLinear,activePassive=:activePassive,autodidacticFramed=:autodidacticFramed,gamesSerious=:gamesSerious,subjectInterdisciplinary=:subjectInterdisciplinary;",
		'par' => array( 'key' => $data->key,'facebookID' => $data->facebookId,'name' => $data->name,'age' => $data->age,'gender' => $data->gender,'profession' => $data->profession,'study' => $data->study,'email' => $data->email,'visualTextual' => $data->visualTextual,'independentSocial' => $data->independentSocial,'bouncyLinear' => $data->bouncyLinear,'activePassive' => $data->activePassive,'autodidacticFramed' => $data->autodidacticFramed,'gamesSerious' => $data->gamesSerious,'subjectInterdisciplinary' => $data->subjectInterdisciplinary),
		'ret' => 'result'
	));
	makeShareImage($data);
	return (object)array("key" =>$data->key);
}

function get($key){
	global $db;
	$row = $db->smartQuery(array(
		'sql' => "select * from data where `key`=:key",
		'par' => array( 'key' => $key),
		'ret' => 'assoc'
	));
	if ($row)
		return $row;
	return null;
}

function getAvrage(){
	global $db;
	$ans=array();
	$table = $db->smartQuery(array(
		'sql' => "SELECT gender, AVG(visualTextual) visualTextual,AVG(independentSocial) independentSocial,AVG(bouncyLinear) bouncyLinear,AVG(activePassive) activePassive,AVG(autodidacticFramed) autodidacticFramed,AVG(gamesSerious) gamesSerious ,AVG(subjectInterdisciplinary) subjectInterdisciplinary from data GROUP BY gender",
		'par' => array(),
		'ret' => 'all'
	));
	foreach ($table as $row){
		$ans[$row["gender"]]=$row;
	}
	$table = $db->smartQuery(array(
		'sql' => "SELECT age, AVG(visualTextual) visualTextual,AVG(independentSocial) independentSocial,AVG(bouncyLinear) bouncyLinear,AVG(activePassive) activePassive,AVG(autodidacticFramed) autodidacticFramed,AVG(gamesSerious) gamesSerious ,AVG(subjectInterdisciplinary) subjectInterdisciplinary from data GROUP BY age",
		'par' => array(),
		'ret' => 'all'
	));
	foreach ($table as $row){
		$ans[$row["age"]]=$row;
	}
	return $ans;
}

function printCSV(){
	global $db;
	$table = $db->smartQuery(array(
		'sql' => "select * from data",
		'par' => array(),
		'ret' => 'all'
	));
	$output = fopen('php://output', 'w');
	if (count($table)==0)return;
	fputcsv($output, array_keys($table[0]));
	foreach($table as $row)
		fputcsv($output, $row);
}

?>