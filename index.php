<?php

include_once("/var/www/html/site/lib/config.php");
include_once("/var/www/html/site/lib/dbconnect.php");

$who=urldecode($_REQUEST['who']);
$from=urldecode($_REQUEST['from']);
$act=urldecode($_REQUEST['act']);
$goto=urldecode($_REQUEST['to']);
$memo=urldecode($_REQUEST['memo']);

// error_log("[affiliate.index] who : ".$who." | from : ".$from." | act : ".$act." | to : ".$goto );

error_log("[affiliate.index]who: ".urldecode($who)." |from: ".urldecode($from)." |act: ".urldecode($act)."|to: ".urldecode($goto)." | memo:".urldecode($memo));

if(strpos($goto,"http://")==0) {
   $act="url"; 
}
$db=new mysql($config["db"]);
$db->connect();
		
$sql="INSERT INTO saja_user.saja_user_affiliate (intro_by, come_from,act ,goto, memo, insertt, modifyt, switch) ";
$sql.="VALUES ('".addslashes($who)."', '".addslashes($from)."', '".addslashes($act)."', '".addslashes($goto)."', '".addslashes($memo)."', NOW(),NOW(),'Y') ";

$db->query($sql);


if($act=='phone' || $act=='tel') { 
    header("Location: tel:".$goto);
} else if($act=='mail') {
    header("Location: mailto:".$goto);
} else {
    if(strpos($goto,"http://")==0) {
	   header("Location: ".$goto);
	} else {
	   header("Location: http://".$goto);
	}
}
 
?>