<?php
class CMSFunction extends DB {
private $db='';
	 public function __construct() {
          $this->db=new DB();
    }

function redirect($url) {
        if (!headers_sent()) {
               header('HTTP/1.1 301 Moved Permanently');
               header('location: '.$url);
               die();
        } else {
                die("<script type='text/javascript'><!--\n
        location.href='$url';\n
        //--></script>\n
        <noscript>\n
        <meta http-equiv='refresh' content='0;url=$url'>\n
        <a href='$url'>Click here</a> to continue...\n
        </noscript>");
        }
}
function getPath($cid) {
		$g=mysql_fetch_assoc(mysql_query("SELECT * FROM category WHERE isactive=1 AND cid='".$cid."' "));
		if ($g['pid']) {
			return getPath($g['pid']).  " >> " . $g['category'];
		} else {
			return $g['category'];
		}
	}
	
	
function getCategories($pid) {
			$category_data = array();
			$q=mysql_query("SELECT * FROM category WHERE isactive=1 AND pid='".$pid."' ") or die(mysql_error());
			while($get=mysql_fetch_assoc($q)){
			$category_data[] = array(
					'cid' => $get['cid'],
					'category' => getPath($get['cid'])
				);
				$category_data = array_merge($category_data, getCategories($get['cid']));
			}
		return $category_data;
	}
	
	
function ago($timestamp){
    $difference = time() - $timestamp;
    $periods = array("year", "month", "day", "hour", "minute");
    $lengths = array("31570560", "2692000", "86400", "3600", "60");
    $text = ''; 
    $TextCount = 0;
	for($j = 0; $j<=4; $j++){
		$count = floor($difference/$lengths[$j]);
		$difference = $difference - ($count*$lengths[$j]);
		if($count > 1) 
		$periods[$j].= "s";
		if($count>0 && $TextCount<2) {
		$TextCount++;
		$text = "$text $count $periods[$j]";
	    }
	}
    $text = ($text == '') ? 'Less than a minute ago' : $text.' ago';
    return $text;
}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
     $ip=$_SERVER['HTTP_CLIENT_IP'];
   }
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   
   {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
   }
   else
   {
 $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function filter($data) {
	$data = trim(htmlentities(strip_tags($data)));
	if (get_magic_quotes_gpc())
	$data = stripslashes($data);
	$data = mysql_real_escape_string($data);
	return $data;
}
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function make_thumb($src,$dest,$desired_width,$desired_height)
{
$size = getimagesize($src);
$mime = $size['mime'];
if ($mime == 'image/jpeg' or  $mime == 'image/pjpeg') {$source_image=imagecreatefromjpeg($src);}
elseif ($mime == 'image/gif') {$source_image=imagecreatefromgif($src);}
elseif ($mime == 'image/png') {$source_image=imagecreatefrompng($src);}
  $width = imagesx($source_image);
  $height = imagesy($source_image);
  //$desired_width = floor($width*($desired_height/$height));
 // $desired_height = floor($height*($desired_width/$width));
  $virtual_image = imagecreatetruecolor($desired_width,$desired_height);
		if (isset($mime) && $mime == 'image/png') {		
			imagealphablending($virtual_image, false);
			imagesavealpha($virtual_image, true);
			$background = imagecolorallocatealpha($virtual_image, 255, 255, 255, 127);
			imagecolortransparent($virtual_image, $background);
		} else {
			$background = imagecolorallocate($virtual_image, 255, 255, 255);
		}
		imagefilledrectangle($virtual_image, 0, 0, $width, $height, $background);
        imagecopyresampled($virtual_image, $source_image,0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
  if ($mime == 'image/jpeg' or  $mime == 'image/pjpeg') {imagejpeg($virtual_image,$dest);}
  elseif ($mime == 'image/gif') {imagegif($virtual_image,$dest);}
  elseif ($mime == 'image/png') {imagepng($virtual_image,$dest);}
}
function unique_file_name($file){
 $id = rand();
	$e = explode(".", $file);
	$n = count($e);
	$ext = $e[$n-1];
	$ext = strtolower($ext);
	$filename = $id.basename(md5($file).".".$ext);
	return $filename;
}


function seourl($url)
{
$normalizeChars = array(
   'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
   'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
   'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
   'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
   'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
   'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
   'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
   'a'=>'a', 'î'=>'i', 'â'=>'a', '?'=>'s', '?'=>'t', 'A'=>'A', 'Î'=>'I', 'Â'=>'A', '?'=>'S', '?'=>'T'
);
$url=strtr(utf8_decode($url), $normalizeChars);
$transformArr = array(' ','  ','   ','/', '&', '"', '(', ')', '.', ',', '?', ':', ' ', '“', '”', ';', '!', '*', '^', '%', '#', '~', '`', '{', '}', '|', '\\', '[', ']', '<', '>');
$url = strtolower($url);
$url = str_replace($transformArr, "-", $url);
$url = str_replace("'","-",$url);
$url = str_replace('&',"and",$url);
$url = str_replace('&amp;',"and",$url);
$url = str_replace("---","-",$url);
$url = str_replace("--","-",$url);
return $url;
}


/*function seourl($url)
{
$transformArr = array(' ','  ','   ','/', '&', '"', '(', ')', '.', ',', '?', ':', ' ', '“', '”', ';', '!', '*', '^', '%', '#', '~', '`', '{', '}', '|', '\\', '[', ']', '<', '>');
$url = strtolower($url);
$url = str_replace($transformArr, "-", $url);
$url = str_replace("'","-",$url);
$url = str_replace('&',"and",$url);
$url = str_replace("---","-",$url);
$url = str_replace("--","-",$url);
return $url;
}*/
function desc($desc)
{
$desc = explode("\\",$desc);
$desc = implode("",$desc);
$desc = preg_replace("'<style[^>]*>.*</style>'siU",'',$desc);
$desc = str_replace("/>", "	", $desc);
$desc = str_replace('\r', "<br />", $desc);
$desc = str_replace('\t', " &nbsp;&nbsp;&nbsp;", $desc);
$desc = nl2br($desc);
return $desc;
}
function search_engine_query_string($url = false) {
   if(!$url) {
        $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
   }
    if($url == false) {
        return '';
    }
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    $search_engines = array(
        'bing' => 'q',
        'google' => 'q',
        'yahoo' => 'p'
    );
    preg_match('/(' . implode('|', array_keys($search_engines)) . ')\./', $parts['host'], $matches);
    return isset($matches[1]) && isset($query[$search_engines[$matches[1]]]) ? $query[$search_engines[$matches[1]]] : '';
}
///paging function
function doPages($page_size, $thepage, $query_string, $total=0) {
    //per page count
    $index_limit = 10;
    //set the query string to blank, then later attach it with $query_string
    $query='';
    if(strlen($query_string)>0){
        $query = "&".$query_string;
    }
    //get the current page number example: 3, 4 etc: see above method description
    $current = get_current_page();
    $total_pages=ceil($total/$page_size);
    $start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;
    echo '';
    if($current==1) {
        echo '< Previous ';
    } else {
        $i = $current-1;
        echo '< Previous ';
        echo '... ';
    }
    if($start > 1) {
        $i = 1;
        echo ''.$i.' ';
    }
    for ($i = $start; $i <= $end && $i <= $total_pages; $i++){
        if($i==$current) {
            echo ''.$i.' ';
        } else {
            echo ''.$i.' ';
        }
    }
    if($total_pages > $end){
        $i = $total_pages;
        echo ''.$i.' ';
    }
    if($current < $total_pages) {
        $i = $current+1;
        echo '... ';
        echo 'Next > ';
    } else {
        echo 'Next > ';
    }
    //if nothing passed to method or zero, then dont print result, else print the total count below:
    if ($total != 0){
        //prints the total result count just below the paging
        echo '(total '.$total.' results)';
    }
}//end of method doPages()
//Both of the functions below required
function check_integer($which) {
    if(isset($_REQUEST[$which])){
        if (intval($_REQUEST[$which])>0) {
            //check the paging variable was set or not,
            //if yes then return its number:
            //for example: ?page=5, then it will return 5 (integer)
            return intval($_REQUEST[$which]);
        } else {
            return false;
        }
    }
    return false;
}//end of check_integer()
function generatePassword($characters){
		$possible = '123456789aBCDEFGHJKLMNPqrstvwxyzAbcdfghjkmnpQRSTUVWXYZ';
		$password = '';
		$i = 0;
		while ($i < $characters)
		{
			$password .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $password;
	}

function generateurl($characters){
		$possible = '123456789';
		$password = '';
		$i = 0;
		while ($i < $characters)
		{
			$password .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $password;
	}


function get_current_page() {
    if(($var=check_integer('page'))) {
        //return value of 'page', in support to above method
        return $var;
    } else {
        //return 1, if it wasnt set before, page=1
        return 1;
    }
}//end of method get_current_page()
//Preparing --Start--
function pageThis($max, $max_page_links, $query, $page_link){
//Uncomment the next 4 lines if don't wish to use this as a function
//$page_link="paged.php";
//$max=30;//Maximum items per page (rows)
//$max_page_links=10;//Maximum links number in the page
//$query="select * from some_table";//Your query
//$num_stuff=mysql_num_rows(mysql_query($query));//Getting the total possible rows

$num_stuff = $this->db->num_rows($query);

if (isset($_GET['page'])&& $_GET['page']>0){
    $start=intval($_GET['page'])-1;//Now the page number make more sense (page=1 is actually the first page)
    $current_page=intval($_GET['page']);//Some cleaning (SQL Injection prevention, and get rid of negative numbers)
}
//If no parameters passed.. just give the first page
else {
    $current_page=1;
    $start=0;
}
//If a large page numbre passed (more than there actually is) just give the last page
if ($current_page>ceil($num_stuff/$max)){
    	$current_page=ceil($num_stuff/$max);
    	$start=ceil($num_stuff/$max)-1;
}
$start*=$max;//Which row to start with
$get_stuff_query=" limit $start, $max";//Adding the limit
//Preparing --End--
//Actual paging --Start--
if ($num_stuff>$max){//Is there any need for pagin?
	if ($current_page>1){//Making previous page & first page links when needed
                $previous_page=$current_page-1;//previousious means -1
                echo "<li><a  href=\"".$page_link."page=1\">First</a></li>  ";//First page is the page number.. you guessed it right.. 1
                echo "<li><a  href=\"".$page_link."page=$previous_page\">Prev</a></li>  ";
            }
            if ($current_page>$max_page_links/2){//Are we going far away from the first viewed page link?
                if (ceil($num_stuff/$max)-$current_page<(($max_page_links/2)+1)){//Are we getting closer to last viewed page link?
                    $start_counter=$current_page-($max_page_links-(ceil($num_stuff/$max)-$current_page));//Yes, Then we need to view more page links
                    $end_counter=ceil($num_stuff/$max);//And no need to view page links more than the query can bring
                }else{
                    $start_counter=$current_page-(($max_page_links/2)-1);//No, then just view some links before the currentrent page
                    $end_counter=$current_page+($max_page_links/2);//And some links after
                }
            }
            else{//Still in the first pages?
                $start_counter=1;//Start with page one
                $end_counter=$max_page_links;//Show only enough links
            }
		
			
			 $end_counter=($max_page_links > $current_page + 9)? $current_page + 9 : $max_page_links;
			
	
			
            for ($i=$current_page;$i<=$end_counter;$i++){//A loop for viewing the links
                if ($i==$end_counter){//Is this the last link?
                    if ($i==$current_page){//Are we actually on the last page? Because we don't need the | after the link
                        echo "<li class=\"active\"><a>".$i."</a></li>";//Then make it look like we're on that page
                    }else{
                        echo "<li><a  href=\"".$page_link."page=".$i."\">".$i."</a></li>";//Well yeah, it's the last link.. but we're not there yet.
                    }
                }elseif($i!=0){{//Not the last page you say.. mmm.. then print normally (with | after the link)
                    if ($i==$current_page){//Are we vewing this page?
                        echo "<li  class=\"active\"><a>".$i."</a> ";//Make us know it
                    }else{//Not viewing.. just a normal link (the most common case here)
                        echo "<li><a  href=\"".$page_link."page=".$i."\">".$i."</a></li>";//Nothing to say
									}
                    }
                }
            }
            if ($current_page<ceil($num_stuff/$max)){//Making the next and last page links
                $next_page=$current_page+1;//Next means +1
                $last_page=ceil($num_stuff/$max);//and the last page is the page.. whell.. it's the last one the query can bring
                echo "<li><a  href=\"".$page_link."page=$next_page\">Next</a></li>";
                echo "<li><a  href=\"".$page_link."page=$last_page\">Last</a></li>";
            }
}
}

}

$f=new CMSFunction();
?>