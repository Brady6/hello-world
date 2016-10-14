<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
		'/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/login.html.php';
	exit();
}


if (userHasRole('Content User'))
{
	

//echo 'Hello ' . $_SESSION['username'];
//echo 'User id is ' . $_SESSION['user_id'];

$user_id=$_SESSION['user_id'];


include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	
//echo 'Channel: ' . $_GET['channel_id'];				
$channel_id=$_GET['channel_id'];


$sql = "SELECT channel,keyval,num_charts,url,name FROM channels WHERE id=$channel_id";
$result = mysqli_query($link, $sql);
if (!$result) {
	$error = 'Error searching channel for channel based on channel_id';
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	exit();}
	
		
$row = mysqli_fetch_array($result);
$channel=$row['channel'];
$keyval=$row['keyval'];


echo '<P style="text-align:center;">';
echo 'Channel Info:';
echo '<BR>';
echo '<BR>';
echo 'name: ' . $row['name'] . '<BR>';
echo 'channel: ' . $row['channel'] . '<BR>';
echo '</P>';


/*
echo 'keyval:' . $row['keyval'] . '<BR>';
echo 'num_charts:' . $row['num_charts'] . '<BR>';
echo 'url:' . $row['url'] . '<BR>';
*/



include $_SERVER['DOCUMENT_ROOT'] . '/admin/logout.inc.html.php';		
		
}


?>		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title>Gauges</title>
		<link href="../tester.css" rel="stylesheet" type="text/css" media="all" />
		<meta name="keywords" content="Flyport, Openpicus, Grove Nest, Thingspeak" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
		<script type='text/javascript' src='https://www.google.com/jsapi'></script>
		<script type="text/javascript" src="../GeneratedItems/jquery.timeago.js" type="text/javascript"></script>	
 		<script type="text/javascript" src="../GeneratedItems/PT7g.js"></script> <!--Adam changed March 24 2014  --> 

 
  </head>      
	<body bgcolor="white" leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="57">
				<td colspan="7" height="57">
					<div align="left">
						<div style="position:relative;width:334px;height:54px;float:right;-adbe-g:p,2,2;">
							<div style="position:absolute;top:36px;left:0px;width:252px;height:16px;-adbe-c:c">
								Values updated <span id="LastUpdate">??? ago</span></div>
							<div style="position:absolute;top:3px;left:254px;width:76px;height:50px;">
								<?php echo '<a title="Gauges and Charts" href="channel2.php?channel_id=' . $channel_id . '&hours_back=24" target="_self"><img src="../images/ch.50.jpg" alt="Gauges and Charts" height="50" width="76" align="right" border="0" /></a></div>';   ?>
							<!--Added March 24 2014 >>>>> -->
							<div style="position:absolute;top:18px;left:0px;width:252px;height:18px;-adbe-c:c">
								Actuator is <span id="ActuatorState">???</span></div>
							<div style="position:absolute;top:0px;left:0px;width:252px;height:16px;-adbe-c:c">
								Switching is <span id="SwitchingState">???</span></div>
							<!--Added March 24 2014 <<<<< -->
						
						
						</div>
					</div>
				</td>
			</tr>
			<tr >
				<td align="center" <div id="chart0div"</div></td>
				 <td align="center"  <div id="chart1div"</div></td>
				 <td align="center"  <div id="chart2div"</div></td>
				  <td align="center"  <div id="chart3div"</div></td>
				   <td align="center"  <div id="chart4div"</div></td>
				   <td align="center"  <div id="chart5div"</div></td>
				   	<td align="center"  <div id="chart6div"</div></td>
			</tr>
			<tr>
				<td height="13" align="center">Casing (PsiG)</td>
				<td height="13" align="center">Tubing (PsiG)</td><!--Adam Added March 24 2014  -->	
				<td height="13" align="center">Upstream (PsiG)</td>
				<td height="13" align="center">Differential (PsiD)</td>
				<td height="13" align="center">Flow (MMcf/D)</td>
				<td height="13" align="center">Line (PsiG)</td>
				<td height="13" align="center">Temperature (DegF)</td>
			</tr>
			<tr>
				<td colspan="7">
					<div align="center">
					<iframe frameborder="0" width="1100" height="300" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/1?width=1100&height=280&results=1440&dynamic=true&color=black&yaxis=PsiG&xaxis=Last 24 Hours&title=Casing&key=<?php echo $keyval;?>"></iframe>
					</div>
				</td>
			</tr>
						<tr>
				<td colspan="7">
					<div align="center">
					<iframe frameborder="0" width="1100" height="300" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/2?width=1100&height=280&results=1440&dynamic=true&yaxis=PsiG&xaxis=Last 24 Hours&title=Tubing&key=<?php echo $keyval;?>"></iframe>
					</div>
				</td>
			</tr>
						
		</table>
		
		
	</body>
</html>



