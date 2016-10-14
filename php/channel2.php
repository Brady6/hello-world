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

	

//Get Variables
$channel_id=$_GET['channel_id'];



if (isset($_GET['hours_back']))
	{
		$hours_back=$_GET['hours_back'];
	}
else
	{
		$hours_back_verbose='Last 24 Hours';		//default is 24 hours	
		$datapoints=300;
	}	


if ($hours_back==1)
{
	$hours_back_verbose='Last Hour';
	$datapoints=13;	
}
elseif ($hours_back==4) {
	$hours_back_verbose='Last 4 Hours';
	$datapoints=52;
}
elseif ($hours_back==8) {
	$hours_back_verbose='Last 8 Hours';
	$datapoints=104;
}
elseif ($hours_back==24) {
	$hours_back_verbose='Last 24 Hours';
	$datapoints=312;
}
elseif ($hours_back==48) {
	$hours_back_verbose='Last 48 Hours';
	$datapoints=624;
}
elseif ($hours_back==72) {
	$hours_back_verbose='Last 72 Hours';
	$datapoints=936;
}
elseif ($hours_back==168) {
	$hours_back_verbose='Last Week';
	$datapoints=2184;
}


	
	
//debug
/*
echo 'hours_back: ' . $hours_back;
echo '<BR>hours_back_verbose: ' . $hours_back_verbose;
echo '<BR>datapoints: ' . $datapoints;
*/



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
echo 'Channel Info';
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
		<script type="text/javascript" src="../GeneratedItems/PT7.js"></script>	
	
  </head>      
	
	<body bgcolor="white" leftmargin="0" marginheight="0" marginwidth="0" topmargin="0">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="57">
				<td colspan="3" nowrap="nowrap" height="57">
					<div align="left">
						
						<div style="position:relative;width:334px;height:57px;float:right;-adbe-g:p,2,2;">
							<div style="position:absolute;top:3px;left:254px;width:76px;height:50px;">
								<?php echo '<a title="Gauges Only" href="channel.php?channel_id=' . $channel_id . '" target="_self"><img src="../images/gs.50.jpg" alt="Gauges Only" height="47" width="77" /></a>';?></div>
							<div style="position:absolute;top:36px;left:0px;width:252px;height:16px;-adbe-c:c">
								Values updated <span id="LastUpdate">??? ago</span></div>
							
						
							
							<div style="position:absolute;top:18px;left:0px;width:252px;height:18px;-adbe-c:c">
								Actuator is <span id="ActuatorState">???</span></div>
							<div style="position:absolute;top:0px;left:0px;width:252px;height:16px;-adbe-c:c">
								Switching is <span id="SwitchingState">???</span></div>
				
						
						
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					
					
					
					<div align="center">
						<strong><font size="2">
						   <?php 
						   
						   if ($hours_back==1)
						   		echo '1 Hour <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==4) 
							   echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> 4 Hour<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==8) 
							   echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> 8 Hour <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==24) 
								echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> 24 Hour <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==48) 
								echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> 48 Hour <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==72) 
								echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> 72 Hour <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=168"> 1 Week</A>';
						   elseif ($hours_back==168) 
								echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=1">  1 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=4">  4 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=8"> 8 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24"> 24 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=48"> 48 Hour</A> <A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=72"> 72 Hour</A> 1 Week';
						    		 												   
						   
						   ?>
					
					</div>
					
					
					
					
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" align="left" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/1?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=PsiG&xaxis=<?php echo $hours_back_verbose;?>&color=black&title=RC 8-17-III Casing&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart0div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/2?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=PsiG&xaxis=<?php echo $hours_back_verbose;?>&color=grey&title=RC 8-17-III Tubing&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart1div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/3?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=PsiG&xaxis=<?php echo $hours_back_verbose;?>&color=red&title=RC 8-17-III Upstream&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart2div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/4?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=PsiD&xaxis=<?php echo $hours_back_verbose;?>&color=blue&title=RC 8-17-III Differential&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart3div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/5?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=MMcF/D&xaxis=<?php echo $hours_back_verbose;?>&color=purple&title=RC 8-17-III Flow&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart4div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/6?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=PsiG&xaxis=<?php echo $hours_back_verbose;?>&color=green&title=RC 8-17-III Line&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart5div"></div></td>
			</tr>
			<tr>
				<td colspan="2">
					<iframe frameborder="0" width="900" height="330" style="border: 0px solid #cccccc;" src="http://api.thingspeak.com/channels/<?php echo $channel;?>/charts/7?width=900&height=330&results=<?php echo $datapoints;?>&dynamic=true&yaxis=DegF&xaxis=<?php echo $hours_back_verbose;?>&color=orange&title=RC 8-17-III Temperature&key=<?php echo $keyval;?>" ></iframe>
				</td>
				<td><div id="chart6div"></div></td>
			</tr>
			
			
			
			
		</table>



	</body>
</html>



