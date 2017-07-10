<?php
function auth ($session,$url) {
	if (!isset($session) || $session != 3) {
		header("location:$url");
		exit();
	}
}
function checkEmpty ($value) {
	if (!isset($value) || empty(trim($value))) {
		return true;
	} else {
		return false;
	}
}
function cleanString ($str) {
	return trim(strip_tags(addslashes($str)));
} 

function issetInput ($input,$val = '') {
	if (isset($_POST[$input])) {
		echo 'value="'.$_POST[$input].'"';
	} else {
		echo 'value="'.$val.'"';
	}
}

function issetTextarea ($input,$val = '') {
	if (isset($_POST[$input])) {
		echo $_POST[$input];
	} else {
		echo $val;
	}
}

function issetInputImage ($input , $data = '' ,$attr = 'src' ) {
	if (isset($_POST[$input])) {
		echo $attr.'="'.$_POST[$input].'"';
	} else {
		if (empty($data)) {
			if ($attr == 'src') {
				echo $attr.'="public/images/upload.png"';
			} else {
				echo $attr.'=""';
			}
			
		} else {
			echo $attr.'="'.$data.'"';
		}
	}
}

function issetSelect ($select,$val,$data = '') {
	if (isset($_POST[$select]) && $_POST[$select] == $val) {
		echo "selected";
	} else {
		if ($data == $val) {
			echo "selected";
		}
	}
}

function isssetCheckbox ($input) {
	if (isset($_POST[$input]) && $_POST[$input] == "on") {
		echo "checked";
	} else {
		echo "checked";
	}
}
function redirect ($url = '') {
	if (empty($url)) {
		header("location:index.php");
		exit();
	} else {
		header("location:index.php?$url");
		exit();
	}
}

function setFlash ($name , $val) {
	if (!isset($_SESSION["flash"][$name])) {
		$_SESSION["flash"][$name] = $val;
	}
}

function hasFlash ($name) {
	if (isset($_SESSION["flash"][$name])) {
		return true;
	} else {
		return false;
	}
}

function getFlash ($name) {
	echo $_SESSION["flash"][$name];
	unset($_SESSION["flash"][$name]);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function form_token () {
	$form_token = generateRandomString(35);
	$_SESSION["token"] = $form_token;
	echo '<input type="hidden" name="token" value="'.$form_token.'" />';
}

function token () {
	if (isset($_SESSION["token"]) && ($_SESSION["token"] == $_POST["token"])) {
		return true;
	} else {
		return false;
	}
}

function emptyToNull ($val) {
	if ($val == "") {
		return;
	} else {
		return $val;
	}
}

function checkId ($id,$url) {
	settype($id , 'int');
	if ($id <= 0) {
		redirect($url);
	}
}

function set_time_current ($time){
	$time = gmdate("H:i:s - d/m/Y", $time + 3600*(7 + date("I")));
	return $time;
}

function url_origin($use_forwarded_host = false) {
    $ssl      = (!empty($_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on');
    $sp       = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr( $sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port     = $_SERVER['SERVER_PORT'];
    $port     = ((!$ssl && $port=='80') || ($ssl && $port == '443')) ? '' : ':'.$port;
    $host     = ($use_forwarded_host && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null);
    $host     = isset( $host ) ? $host : $_SERVER['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url($use_forwarded_host = false) {
    return url_origin($_SERVER,$use_forwarded_host ) . $_SERVER['REQUEST_URI'];
}

function logIp () {
	$filename = "log.html";
	if(file_exists($filename) && filesize($filename) >= (50*1024)){
	     unlink($filename);
	} else {
		$file = fopen("log.html", "a");
		fwrite($file, "<b>Time: </b>".set_time_current(time())."<br/>");
		fwrite($file, "<b>Ip Address: </b>".$_SERVER['REMOTE_ADDR']."<br/>");
		fwrite($file, "<b>Referer: </b>".full_url()."<br />");
		fwrite($file, "<b>Browser: </b>".$_SERVER['HTTP_USER_AGENT']."<hr/>");
		fclose($file);
	}
}

function checkExt($filename,$extensionImage){
    $pos = strrpos($filename, ".") + 1;
    $ext = substr($filename, $pos);
    if(in_array($ext,$extensionImage)){
        return true;
    }else{
        return false;
    }
}

function changeName($filename){
    $name = strtolower($filename);
    $name = str_replace(" ", "_", $name);
    $name = time() . "_" . $name;
    return $name;
}

function time_elapsed_string ($ptime) {
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '0 giây';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'năm',
                 30 * 24 * 60 * 60  =>  'tháng',
                      24 * 60 * 60  =>  'ngày',
                           60 * 60  =>  'giờ',
                                60  =>  'phút',
                                 1  =>  'giây'
                );

    $a_plural = array( 'năm'   	=> 'năm',
                       'tháng'  => 'tháng',
                       'ngày'   => 'ngày',
                       'giờ'   	=> 'giờ',
                       'phút' 	=> 'phút',
                       'giây' 	=> 'giây'
                );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' trước';
        }
    }
}

function CurrencyToString($amount) {
    if($amount <=0) {
        return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
    }

    $text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
    $textluythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
    $textnumber = "";
    $length = strlen($amount);
    
    for ($i = 0; $i < $length; $i++){
    	$unread[$i] = 0;
    }
    
    for ($i = 0; $i < $length; $i++) {               
        $so = substr($amount, $length - $i - 1 , 1);                
        if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
            for ($j = $i+1 ; $j < $length ; $j ++) {
                $so1 = substr($amount,$length - $j -1, 1);
                if ($so1 != 0) {
                    break;
                }
            }                       
            if (intval(($j - $i )/3) > 0){
                for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++) {
                    $unread[$k] =1;
                }
            }
        }
    }
    
    for ($i = 0; $i < $length; $i++) {        
        $so = substr($amount,$length - $i - 1, 1);       
        if ($unread[$i] == 1) {
        	continue;
        }
        
        if (($i% 3 == 0) && ($i > 0)) {
        	$textnumber = $textluythua[$i/3] ." ". $textnumber; 
        }
            
        if ($i % 3 == 2 ) {
        	$textnumber = 'trăm ' . $textnumber;
        }
       
        if ($i % 3 == 1) {
        	$textnumber = 'mươi ' . $textnumber;
        }
        
        $textnumber = $text[$so] ." ". $textnumber;
    }
    
    $textnumber = str_replace("không mươi", "lẻ", $textnumber);
    $textnumber = str_replace("lẻ không", "", $textnumber);
    $textnumber = str_replace("mươi không", "mươi", $textnumber);
    $textnumber = str_replace("một mươi", "mười", $textnumber);
    $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
    $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
    $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
    
    return ucfirst($textnumber." đồng chẵn");
}

function convertSize($size, $totalDigit = 2, $ditance = ' '){
	$units	= array('B', 'KB', 'MB', 'GB', 'TB');
 
	$length	= count($units);
	for($i = 0; $i < $length; $i++){
		if($size > 1024) {
			$size	= $size / 1024;
		}else {
			$unit	= $units[$i];
			break;
		}
	}
 
	$result = round($size, $totalDigit) . $ditance . $unit;
	return $result;
}

function recursionSelect ($data,$selected = 0,$parent = 0,$str = '') {
	foreach ($data as $key => $value) {
		$id        = $value["id"];
		$name   = $value["name"];
		$parent_id = $value["parent_id"];
		if ($parent_id == $parent) {
			if ($id == $selected) {
				echo '<option value="'.$id.'" selected>'.$str.$name.'</option>';
			} else {
				echo '<option value="'.$id.'">'.$str.$name.'</option>';
			}
			unset($data[$key]);
			recursionSelect ($data,$selected,$id,$str . "---|" . " ");
		}
	}	
}

function recursionTable ($data,$parent = 0,$str = '') {
	foreach ($data as $key => $value) {
		$id        = $value["id"];
		$name   = $value["name"];
		$description=$value["description"];
		$parent_id = $value["parent_id"];
		$position  = $value["position"];
		$status    = ($value["status"] == "On") ? "checked" : "";
		if ($parent_id == $parent) {
			echo'
			<tr>
				<td>'.$str.' <input name="txtPosition" type="text" class="text-center"  value="'.$position.'" style="width: 30px" data-id="'.$id.'"></td>
				<td style="color:blue">'.$str.''.$name.'</td>
				<td>'.$description.'</td>
				<td><input type="checkbox" name="chkStatus" data-on-color="success" data-off-color="danger" data-on-text="On" data-off-text="Off" class="switch" data-table="news_category" data-col="status" data-id="'.$id.'" '.$status.' /></td>
				<td class="text-center">
					<ul class="icons-list">
						<li class="text-primary-600"><a href="index.php?controller=category&action=edit&cid='.$id.'" data-popup="tooltip" title="Edit"><i class="icon-pencil7"></i></a></li>
						<li class="text-danger-600"><a href="index.php?controller=category&action=delete&cid='.$id.'" data-popup="tooltip" title="Remove" class="sweet_warning"><i class="icon-trash"></i></a></li>
					</ul>
				</td>
			</tr>';
			unset($data[$key]);
			recursionTable ($data,$id,$str . "---|" . " ");
		}
	}	
}

function recursionList ($data,$checked = array(),$parent = 0,$level = 0) {
	$child = array();
	foreach ($data as $key => $value) {
		if ($value["parent_id"] == $parent) {
			$child[] = $value;
		}
	}

	if ($child) {
		if ($level == 0) {
			echo '<ul class="list list-condensed no-margin-bottom">';
		} else {
			echo '<ul class="list">';
		}
		foreach ($child as $key => $value) {
			$id        = $value["id"];
			$name   = $value["name"];
			$parent_id = $value["parent_id"];
			if (!empty($checked) && in_array($id,$checked)) {
				$input = '<input class="chkCategory" type="checkbox" name="chkCategory[]" value="'.$id.'" checked /> '.$name;
			} else {
				$input = '<input class="chkCategory" type="checkbox" name="chkCategory[]" value="'.$id.'" /> '.$name;
			}
			

			echo '<li>'.$input;
			recursionList ($data,$checked,$id,++$level);
			echo '</li>';
		}
		echo '</ul>';
	}
}

function get_client_ip() {
   $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

   return $ipaddress;
} 

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

/*** Sử dụng 
Cách 1 
echo ip_info("Visitor", "Country"); // India
echo ip_info("Visitor", "Country Code"); // IN
echo ip_info("Visitor", "State"); // Andhra Pradesh
echo ip_info("Visitor", "City"); // Proddatur
echo ip_info("Visitor", "Address"); // Proddatur, Andhra Pradesh, India

print_r(ip_info("Visitor", "Location")); // Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )

Cách 2
echo ip_info("Visitor", "Country"); // India
echo ip_info("Visitor", "Country Code"); // IN
echo ip_info("Visitor", "State"); // Andhra Pradesh
echo ip_info("Visitor", "City"); // Proddatur
echo ip_info("Visitor", "Address"); // Proddatur, Andhra Pradesh, India

print_r(ip_info("Visitor", "Location")); // Array ( [city] => Proddatur [state] => Andhra Pradesh [country] => India [country_code] => IN [continent] => Asia [continent_code] => AS )
****/

function reverse_array_key ($array) {
    $arr_key = array_reverse(array_keys($array));
    $arr_val = array_reverse(array_values($array));
    $combine = array_combine($arr_key, $arr_val);
    return $combine;
}
?>