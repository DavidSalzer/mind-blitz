<?php
#from php-form-builder-class
class Spreadsheet {
	private $token;
	private $spreadsheetid;
	private $worksheetid;
	private $allData;
	private $ColumnIDs;
	
	public function __construct() {
		
	}
 
	public function authenticate($username, $password) {
		$url = "https://www.google.com/accounts/ClientLogin";
		$fields = array(
			"accountType" => "HOSTED_OR_GOOGLE",
			"Email" => $username,
			"Passwd" => $password,
			"service" => "wise",
			"source" => "pfbc"
		);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
		$response = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
	
		if($status == 200) {
			if(stripos($response, "auth=") !== false) {
				preg_match("/auth=([a-z0-9_\-]+)/i", $response, $matches);
				$this->token = $matches[1];
				//echo $this->token;
			}
		}
	}
 
	public function setSpreadsheetId($id) {
		$this->spreadsheetid = $id;
		return $this;
	}

	public function setWorksheetId($id) {
		$this->worksheetid = $id;
		return $this;
	}
	
 
	public function add($data) {
		if(!empty($this->token)) {
			$url = "https://spreadsheets.google.com/feeds/list/" . $this->spreadsheetid . "/" . $this->worksheetid . "/private/full";
			if(!empty($url)) {
				$headers = array(
					"Content-Type: application/atom+xml",
					"Authorization: GoogleLogin auth=" . $this->token,
					"GData-Version: 3.0"
				);
				$columnIDs = $this->getColumnIDs();
				if($columnIDs) {
					$fields = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended">';
					foreach($data as $key => $value) {
						$key = $this->formatColumnID($key);
						if(in_array($key, $columnIDs))
							$fields .= "<gsx:$key><![CDATA[$value]]></gsx:$key>";
					}
					$fields .= '</entry>';
					//echo ($fields);
 
					$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
					$response = curl_exec($curl);
					$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
					curl_close($curl);
				}
			}
		}
	}
	
	public function delete($rowId) {
		if(!empty($this->token)) {
			$url = "https://spreadsheets.google.com/feeds/list/" . $this->spreadsheetid . "/" . $this->worksheetid . "/private/full/".$rowId;
			if(!empty($url)) {
				$headers = array(
					"Content-Type: application/atom+xml",
					"Authorization: GoogleLogin auth=" . $this->token,
					"GData-Version: 3.0"
				);
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, "");
				$response = curl_exec($curl);
				$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				curl_close($curl);
			}
		}
	}
	
	public function searchCol($ColumnID,$val){
		$ColumnIDs=$this->getColumnIDs();
		$allData=$this->getAllData();
		$col=$this->formatColumnID(isset($ColumnIDs[$ColumnID])?$ColumnIDs[$ColumnID]:$ColumnID);
		foreach ($allData as $key => $value){
			if (isset($value->$col) && $value->$col==$val) return $key;
		}
		return null;
	}
	
	public function getColumnIDs(){
		if(!isset($this->ColumnIDs))
			$this->downloadData();
		return $this->ColumnIDs;
	}
	
	public function getAllData(){
		if(!isset($this->allData))
			$this->downloadData();
		return $this->allData;
	}
	
	private function downloadData(){
		//if( !isset($this->worksheetid)) $this-> getPostUrl();
		$url=null;$headers;
		if(empty($this->token)) {
			$url = "https://spreadsheets.google.com/feeds/list/" . $this->spreadsheetid . "/" . $this->worksheetid . "/public/full";
			$headers = array(
				"GData-Version: 3.0"
			);
		}
		else{
			$url = "https://spreadsheets.google.com/feeds/list/" . $this->spreadsheetid . "/" . $this->worksheetid . "/private/full";
			$headers = array(
				"Authorization: GoogleLogin auth=" . $this->token,
				"GData-Version: 3.0"
			);
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($curl);
 
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		if($status == 200) {
		
			$this->allData = array();
			$this->ColumnIDs = array();
			$xml = simplexml_load_string($response);
			foreach ($xml -> entry as $row)
			{
				$id=str_replace("\n", "", basename($row->id).PHP_EOL);
				$this->allData[$id]=new stdClass();
				$col = $row->children('gsx', TRUE);
				foreach ($col as $key=>$value){
					$this->allData[$id]->$key=(string)$value;
					if(!in_array($key,$this->ColumnIDs))
						$this->ColumnIDs[]=$key;
				}
				
			}			
		}
	}
 
	private function formatColumnID($val) {
		return preg_replace("/[^a-zA-Z0-9.-]/", "", strtolower($val));
	}
}
?>