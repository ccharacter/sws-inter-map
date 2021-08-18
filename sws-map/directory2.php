<?php
session_start();

// echo getcwd();

require_once '../inc/dir/assets/Db.php';
require_once '../inc/dir/assets/dir_functions.php';

if (!(isset($_SESSION['sew']['which']))) { $_SESSION['sew']['which']="cm"; $my_min="cm";} else { 
	$my_min=$_SESSION['sew']['which'];}
$db = new DB_map();

// VALIDATE GET VAR
if (isset($_GET['id'])) {
 	$id=$_GET['id'];	
} else {$id="ANP";}

  $fileName=$id.".php";
  $u_name=sew_retrieve_itemname("full_text","COMMON_temp_union",$id,"id");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Interactive Directory</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<link href='//fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
<link href='assets/dir_styles.css' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="//min-db1.nadadventist.org/javascript/sew_spamspan.js"></script>
<!--[if IE]>
<style>
	.column1 { min-height: 450px;}
</style><![endif]-->
</head>
<body style="font-family: 'Questrial', sans-serif;">
<script type="text/javascript">
function showOne(id) {
    $('.details').not(id).addClass('hideClass');
    $('#'+ id).removeClass('hideClass'); 	
}   
</script>

<div class='container' style='width:100%'>	
  <p style='padding: 8px; text-align:center; '>Hover/click a state/province to see contact information for Children's Ministries leadership.<br /><a href='directory.php'><strong>BACK TO DIVISION</strong></a></p>
  <div id="ejj_container" style='margin-top:-25px'>
<?php  
	if (!($fileName=="ANN.php")) {
		include $fileName; 
	} ?>
	<div class="column2">
<?php  
if ((!(isset($_GET['s']))) || (!($_GET['s']=="GU"))) {
min_list_union($u_name,$id,"N","N",4,"Y","N"); 
min_interactive_state_divs($id);
min_interactive_conf_divs($id);
} else { 
	
	echo "<h3>Guam-Micronesia Mission</h3>";
	
	$sql="select * from dbi_master where conference like \"%Guam%\" and groups like '%:7:%' order by lastname"; error_log($sql,0); 
$conf_array = $db -> select($sql); 
	if (count($conf_array)>0) {
			foreach ($conf_array as $key=>$value) {
				echo "<hr />";
				$row=$conf_array[$key];
				error_log(print_r($row,true),0); 
				min_directory($row,"N","N","Y","Y","N","Y",$u_group,"N","Y"); 
// min_directory($row, $edit="Y", $show_groups="Y", $show_dir="Y", $show_conf="N", $show_union="N",$link_site="N", $u_group=4,$outerDiv="Y",$confWord="N")					
			
			} 
		} else { echo "<hr /> NONE LISTED for <strong>$conf_name</strong></hr>";}

	
}
?>
	</div>
<?php
 if (isset($_GET['s'])) { echo "<script type='text/javascript'>showOne('".$_GET['s']."');</script>"; } 
 if (isset($_GET['c'])) { echo "<script type='text/javascript'>showOne('".$_GET['c']."');</script>"; }
?>
    </div></div>
       <script src="assets/dir_script.js"></script>	
</body>

</html>