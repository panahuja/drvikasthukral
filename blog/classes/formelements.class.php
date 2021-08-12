<?php
class FormElement extends DB {
private $db='';
	 public function __construct() {
          $this->db=new DB();
    }
function ListValues($list, $selected=false, $con=false){
$str='';
		if(isset($list) && trim($list) != ''){
			switch($list){
				case "template":
					$id = "tid";
					$name = "name";
					$table = "template";
					$status = "AND status='1'";
					$order = "order by name asc";
				break;
				case "category":
					$id = "cid";
					$name = "cName";
					$table = "category";
					$status = "AND cStatus='Enable'";
					$order = "order by cOrder asc";
				break;
			}
		}
		
		$q="SELECT $id, $name FROM $table WHERE isactive='1'  $status   $con   $order";
		$rows=$this->db->get_results($q);
		
		foreach($rows as $row){
		
			$option = ($row[$id] == $selected) ? ' selected="selected"' : '';
			$str .= '<option value="'.$row[$id].'"'.$option.'>'.$row[$name].'</option>';
		}
		return $str;
	}
	
function ListValuesm($list, $selected=false, $con=false){
$str='';
 
		if(isset($list) && trim($list) != ''){
			switch($list){
			
			
				
					case "language":
					$id = "language";
					$name = "language";
					$table = "language";
					$status = "AND status='1'";
					$order = "order by sorder asc";
				break;
				
				case "workpermit":
					$id = "country";
					$name = "country";
					$table = "country";
					$status = "AND status='1'";
					$order = "order by country asc";
				break;
				
			}
		}
		
		$q="SELECT $id, $name FROM $table WHERE isactive='1'  $status   $con   $order";
		$rows=$this->db->get_results($q);
		
		$selectarr=explode(", ",$selected);
		
		foreach($rows as $row){
		
if (in_array($row[$id], $selectarr)) {
    $option = ' selected="selected"';
}else{
$option = '';
}
			
	
			
			
			$str .= '<option value="'.$row[$id].'"'.$option.'>'.$row[$name].'</option>';
		}
		return $str;
	}
}
$FE = new FormElement();
?>