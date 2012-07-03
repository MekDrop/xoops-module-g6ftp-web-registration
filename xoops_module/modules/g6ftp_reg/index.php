<?

require './include/shared.php';
include_once "../../mainfile.php";
include XOOPS_ROOT_PATH.'/header.php';

define('g6path',getmoduleoption('g6path','g6ftp_reg'));
define('host',getmoduleoption('host','g6ftp_reg'));
define('template',getmoduleoption('template','g6ftp_reg'));

define('crlf',"\r\n");

//ob_start();

function write_ini_file($path, $assoc_array) 
{
   $content = '';
   $sections = '';

   foreach ($assoc_array as $key => $item) 
   {
       if (is_array($item)) 
       {
           $sections .= "[{$key}]".crlf;
           foreach ($item as $key2 => $item2) 
           {
               if (is_numeric($item2) || is_bool($item2))
                   $sections .= "{$key2}={$item2}".crlf;
               else
                   $sections .= "{$key2}={$item2}".crlf;
           }      
       } 
       else 
       {
           if(is_numeric($item) || is_bool($item))
               $content .= "{$key}={$item}".crlf;
           else
               $content .= "{$key}={$item}".crlf;
       }
   }      

   $content .= $sections;

   if (!$handle = fopen($path, 'w')) 
   {
       return false;
   }
   
   if (!fwrite($handle, $content)) 
   {
       return false;
   }
   
   fclose($handle);
   return true;
}

function check_data($post) {
	include_once XOOPS_ROOT_PATH.'/modules/g6ftp_reg/GeoIP/geoip.inc';
    $gi = geoip_open(XOOPS_ROOT_PATH.'/modules/g6ftp_reg/GeoIP/GeoIP.dat',GEOIP_STANDARD);
	if (strlen(geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']))>0) {
		$data = explode("|",getmoduleoption('country','g6ftp_reg'));
		if (count($data)>0)
			foreach ($data as $value)
				if (strtolower(geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']))!=strtolower($value)) {
					error(_G6FR_MI_ERROR_COUNTRY);		
					return false;
				}
	}
	if(!preg_match("/^[a-z0-9][\w.-]*$/i",$post['login'])) {
		error(_G6FR_MI_ERROR_USERNAME);
		return false;
	}
	if ($post['password2']!=$post['password']) {
		error(_G6FR_MI_ERROR_PASS1);
		return false;
	}
	if (strlen(trim($post['password']))<6) {
		error(_G6FR_MI_ERROR_PASS1);
		return false;
	}
	return true;
}

function error ($message) {
	global $content, $header;
	$content = $message;
	$header = _G6FR_MI_ERROR;
}

if (isset($_POST['login'])) {
	if (file_exists(g6path."\\Accounts\\".host."\\users\\".$_POST['login'].".ini")) {		
		error(_G6FR_MI_ERROR_EXISTS);
	} else {
		if (check_data($_POST)) {
			if (file_exists(g6path."\\Accounts\\".host."\\users\\".template.".ini")) {
				$array = parse_ini_file(g6path."\\Accounts\\".host."\\users\\".template.".ini",true);
			} else {
				$array = array();
			}
			$array["Account"]["Password"] = ":".$_POST['password'];
			$array["Account"]["Email"] = $_POST['email'];
			$array["Account"]["StatsFailedDownloads"] = 0;
			$array["Account"]["StatsFilesDownloaded"] = 0;
			$array["Account"]["StatsUploaded"] = 0;
			$array["Account"]["StatsLogin"] = "";
			$array["Account"]["StatsLastUsername"] = $_POST['login'];
			$array["Account"]["StatsLastIP"] = "";
			$array["Account"]["StatsDownloaded"] = "";
			$array["Account"]["Enabled"] = -1;
			$array["Account"]["ParentClass"] = getmoduleoption('class','g6ftp_reg');
		    $gi = geoip_open(XOOPS_ROOT_PATH.'/modules/g6ftp_reg/GeoIP/GeoIP.dat',GEOIP_STANDARD);
			$array["Account"]["Notes"] = "Country->".geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
			write_ini_file(g6path."\\Accounts\\".host."\\users\\".$_POST['login'].".ini",$array);
			$header = _G6FR_MI_FTPREG;
			$content =  _G6FR_MI_REGISTERED;
		}
	}
} else {

	$header = _G6FR_MI_FTPREG;
	$content =  '<FORM METHOD="POST" ACTION="index.php">';
	$content .= '<TABLE>';
	$content .= '<TR>';
	$content .= '<TD>'._G6FR_MI_USER_NAME.'</TD>';
	$content .= '<TD><INPUT TYPE="text" NAME="login"></TD>';
	$content .= '</TR>';
	$content .= '	<TR>';
	$content .= '		<TD>'._G6FR_MI_PASSWORD.'</TD>';
	$content .= '		<TD><INPUT TYPE="password" NAME="password"></TD>';
	$content .= '	</TR>';
	$content .= '	<TR>';
	$content .= '		<TD>'._G6FR_MI_REPEAT_PASSWORD.'</TD>';
	$content .= '		<TD><INPUT TYPE="password" NAME="password2"></TD>';
	$content .= '	</TR>';
	$content .= '	<TR>';
	$content .= '		<TD>'._G6FR_MI_EMAIL.'</TD>';
	$content .= '		<TD><INPUT TYPE="text" NAME="email"></TD>';
	$content .= '	</TR>';
	$content .= '	<TR>';
	$content .= '		<TD></TD>';
	$content .= '		<TD><INPUT TYPE="submit" value="'._G6FR_MI_REGISTER.'"></TD>';
	$content .= '	</TR>';
	$content .= '	</TABLE>';
	$content .= '	</FORM>';
}

//$smarty = new Smarty;

$xoopsTpl->assign("header",$header);
$xoopsTpl->assign("content",$content);
$xoopsOption['template_main'] = "index.tpl";

//$smarty->display('index.tpl');

include XOOPS_ROOT_PATH."/footer.php";

?>