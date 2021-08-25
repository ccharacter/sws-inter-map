<?php

session_start();

include "assets/Db.php";
include "assets/functions_sws.php";
include "assets/dir_functions.php";


//$_SESSION['sew']['which']="fam";

if (isset($_GET['vars'])) { // process url vars
	$tmp=json_decode(base64_decode(urldecode($_GET['vars'])),true);
	foreach ($tmp as $key=>$value) {
		$_SESSION['sws'][$key]=$value;
		${$key}=$value;
		//error_log($key."|".$value,0);
	}
	if (strpos($group,",")===false) { // only one group
		sws_get_group_id($group);
	} else { // multiple groups
		$tmp=explode(",",$group); $k=2;
		foreach ($tmp as $tmp2) {
			$tmp2=trim($tmp2);
			error_log("HAS GROUP $tmp2",0);
			sws_get_group($tmp2,"group_id$k");
			$k++;
		}
	}
} else {
	foreach ($_SESSION['sws'] as $key=>$value) {
		${$key}=$value;
		//error_log($key."|".$value,0);
	}
}

sws_iframe_head($themedir,$themedir2);

?>
<div style='width:100%'>
<?php

 ejj_list_unions($min_title);

?></div>
</body></html>
