<?php
class PageLink extends DB {
private $db='';
	 public function __construct() {
          $this->db=new DB();
    }
function LinkValues($selected=false){ 
		$str='';
		$q="SELECT  ppage, spName FROM staticpage WHERE  isactive='1'  AND status='1'";
		$rows=$this->db->get_results($q);
		foreach($rows as $row){
		if($row['ppage']==0){
		$pagename=$row['spName'];
		}else{
		$pq="SELECT spName, ppage FROM staticpage WHERE  isactive=1  AND status=1 AND spid='".$row['ppage']."'";
		$prows=$this->db->get_results($pq);
		foreach($prows as $p){
		$pagename=$p['spName']." &raquo; ".$row['spName'];
		}
		if($p['ppage']!=0){
		$ppq="SELECT spName, ppage FROM staticpage WHERE  isactive=1  AND status=1 AND spid='".$row['ppage']."'";
		$pprows=$this->db->get_results($ppq);
		foreach($pprows as $pp){
		$pagename=$pp['spName']." &raquo; ".$p['spName']." &raquo; ".$row['spName'];
		}
		}
		}
			$option = ($row['spName'] == $selected) ? " selected" : "";
			$str .= '<option value="'.$row['spName'].'"'.$option.'>'.$pagename.'</option>';
		}
		$option = ($selected == "javascript:void(0)") ? ' selected' : '';
		$str .= '<option value="javascript:void(0)" '.$option.'>No Link</option>';
		
		$option = ($selected == "blog/") ? ' selected' : '';
		$str .= '<option value="blog/" '.$option.'>Blog</option>';
		return $str;
	}
}
$PL = new PageLink();
?>