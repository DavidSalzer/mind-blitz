<?php

require 'SimpleImage.php';

$shareFolder="../shareimage";
$partsFolder=$shareFolder."/parts";
$profileImageFolder=$shareFolder."/profileImage";

$scales=array(  // +87
	"visualTextual" => array(
		"top" => "38",
		"leftStart" => $partsFolder."/a1.jpg",
		"left" => $partsFolder."/a2.jpg",
		"rightStart" => $partsFolder."/eye1.jpg",
		"right" => $partsFolder."/eye2.jpg",
	),
	"independentSocial" => array(
		"top" => "125",
		"leftStart" => $partsFolder."/42.jpg",
		"left" => $partsFolder."/43.jpg",
		"rightStart" => $partsFolder."/46.jpg",
		"right" => $partsFolder."/45.jpg",
	),
	"bouncyLinear" => array(
		"top" => "215",
		"leftStart" => $partsFolder."/33.jpg",
		"left" => $partsFolder."/34.jpg",
		"rightStart" => $partsFolder."/37.jpg",
		"right" => $partsFolder."/35.jpg",
	),
	"activePassive" => array(
		"top" => "301",
		"leftStart" => $partsFolder."/23.jpg",
		"left" => $partsFolder."/24.jpg",
		"rightStart" => $partsFolder."/27.jpg", 
		"right" => $partsFolder."/26.jpg",
	),
	"autodidacticFramed" => array(
		"top" => "390",
		"leftStart" => $partsFolder."/15.jpg",
		"left" => $partsFolder."/16.jpg",
		"rightStart" => $partsFolder."/18.jpg",
		"right" => $partsFolder."/17.jpg",
	),
	"gamesSerious" => array(
		"top" => "478",
		"leftStart" => $partsFolder."/03.jpg",
		"left" => $partsFolder."/05.jpg",
		"rightStart" => $partsFolder."/09.jpg",
		"right" => $partsFolder."/07.jpg",
	),
	"subjectInterdisciplinary" => array(
		"top" => "564",
		"leftStart" => $partsFolder."/50.jpg", 
		"left" => $partsFolder."/51.jpg", 
		"rightStart" => $partsFolder."/52.jpg", 
		"right" => $partsFolder."/53.jpg", 
	)

);

function makeShareImage($data){
	global $partsFolder;
	global $shareFolder;
	global $profileImageFolder;
	global $scales;
	try {
		$img = new abeautifulsite\SimpleImage($partsFolder."/image.jpg");
		
		//-----------name----------------------
		$name=$data->name;
		if(preg_match("/\p{Hebrew}/u", $name))
			$name=utf8_strrev($name);
		$img->text($name, 'Alef-Bold.ttf', 25, '#FFFFFF', 'top right',-160,85);
		//$img->text($name, 'Alef-Regular.ttf', 25, '#FFFFFF', 'top right',-160,125);
		
		//-----------profileImage----------------------
		$profileImagePath=$partsFolder."/defult_profile.jpg";
		if($data->facebookId){
			$profileImage = file_get_contents('https://graph.facebook.com/'.substr($data->facebookId,1).'/picture?type=normal');
			$profileImagePath = $profileImageFolder."/".$data->facebookId.".jpg";
			file_put_contents($profileImagePath, $profileImage);
		}
		$img->overlay($profileImagePath, "top right", 1, -25, 25);
		
		//-------------- scales-------------------------
		foreach ($scales as $key=>$val){
			$x=$data->$key;
			if($x>5){
				$img->overlay($val["leftStart"], "top left", 1, 29, $val["top"]);
				for($i=0;$i<$x*2;$i++)
					$img->overlay($val["left"], "top left", 1, 72+($i*34), $val["top"]);
			}
			else{
				$img->overlay($val["rightStart"], "top left", 1, 698, $val["top"]);
				for($i=0;$i<(10-$x)*2;$i++)
					$img->overlay($val["right"], "top left", 1, 664-($i*34), $val["top"]);
			}
		}
		
		$img->save($shareFolder."/".$data->key.".png");
	} catch(Exception $e) {
		echo '<span style="color: red;">' . $e->getMessage() . '</span>';
	}
}

function utf8_strrev($str){
    preg_match_all('/./us', $str, $ar);
    return join('',array_reverse($ar[0]));
}
/*

$data=new stdClass();
$data->key="test1";
$data->visualTextual=1;
$data->activePassive=1;
$data->autodidacticFramed=1;
$data->bouncyLinear=1;
$data->gamesSerious=1;
$data->independentSocial=1;
$data->subjectInterdisciplinary=1;
$data->facebookId="f1848505408708013";
$data->name="Reut Cambium";
makeShareImage($data);

$data=new stdClass();
$data->key="test2";
$data->visualTextual=2;
$data->activePassive=2;
$data->autodidacticFramed=2;
$data->bouncyLinear=2;
$data->gamesSerious=2;
$data->independentSocial=2;
$data->subjectInterdisciplinary=2;
$data->facebookId="f10152563050489683";
$data->name="Ilan Ben Yaakov";
makeShareImage($data);

$data=new stdClass();
$data->key="test3";
$data->visualTextual=3;
$data->activePassive=3;
$data->autodidacticFramed=3;
$data->bouncyLinear=3;
$data->gamesSerious=3;
$data->independentSocial=3;
$data->subjectInterdisciplinary=3;
$data->facebookId="f10152173829433519";
$data->name="Avi Warshavsky";
makeShareImage($data);

$data=new stdClass();
$data->key="test4";
$data->visualTextual=4;
$data->activePassive=4;
$data->autodidacticFramed=4;
$data->bouncyLinear=4;
$data->gamesSerious=4;
$data->independentSocial=4;
$data->subjectInterdisciplinary=4;
$data->facebookId=null;
$data->name="דניאל לבנון";
makeShareImage($data);

$data=new stdClass();
$data->key="test5";
$data->visualTextual=5;
$data->activePassive=5;
$data->autodidacticFramed=5;
$data->bouncyLinear=5;
$data->gamesSerious=5;
$data->independentSocial=5;
$data->subjectInterdisciplinary=5;
$data->facebookId="f10152438468620590";
$data->name="Ran Magen";
makeShareImage($data);

$data=new stdClass();
$data->key="test6";
$data->visualTextual=6;
$data->activePassive=6;
$data->autodidacticFramed=6;
$data->bouncyLinear=6;
$data->gamesSerious=6;
$data->independentSocial=6;
$data->subjectInterdisciplinary=6;
$data->facebookId="f10203463373879023";
$data->name="Rotem Gitlin";
makeShareImage($data);

$data=new stdClass();
$data->key="test7";
$data->visualTextual=7;
$data->activePassive=7;
$data->autodidacticFramed=7;
$data->bouncyLinear=7;
$data->gamesSerious=7;
$data->independentSocial=7;
$data->subjectInterdisciplinary=7;
$data->facebookId=null;
$data->name="דניאל 7";
makeShareImage($data);

$data=new stdClass();
$data->key="test8";
$data->visualTextual=8;
$data->activePassive=8;
$data->autodidacticFramed=8;
$data->bouncyLinear=8;
$data->gamesSerious=8;
$data->independentSocial=8;
$data->subjectInterdisciplinary=8;
$data->facebookId=null;
$data->name="דניאל  8";
makeShareImage($data);

$data=new stdClass();
$data->key="test9";
$data->visualTextual=9;
$data->activePassive=9;
$data->autodidacticFramed=9;
$data->bouncyLinear=9;
$data->gamesSerious=9;
$data->independentSocial=9;
$data->subjectInterdisciplinary=9;
$data->facebookId=null;
$data->name="דניאל  9";
makeShareImage($data);
*/