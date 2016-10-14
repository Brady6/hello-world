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

//get list of available channels to view

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	
$sql = "SELECT id,channel,name FROM channelsid_userid INNER JOIN channels ON channels_id=id WHERE user_id=$user_id";
$result = mysqli_query($link, $sql);
if (!$result) {
	$error = 'Error searching channel for user.';
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/error.html.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/admin/logout.inc.html.php';		
	exit();}
	
		
while ($row = mysqli_fetch_array($result))
	{
	//arrays of array, to support access to more than one channel for a user
	$channels_info[] = array('channel_id' => $row['id'],'channel' => $row['channel'], 'name' => $row['name']);
	

	}
	
echo '<P style="text-align:center; font-size:1.2em;">';
echo 'The available channels are:';
echo '<BR>';
echo '<BR>';
echo '</P>';


foreach ($channels_info as $channel): 
				echo '<li style="text-align:center; font-size:1.2em;">';
				
				$chan=$channel['channel'];
				$name=$channel['name'];
				$channel_id=$channel['channel_id'];
				
				echo '<A HREF="channel2.php?channel_id=' . $channel_id . '&hours_back=24">' . $chan . ' | ' . $name . '</A>';
									
							
				echo '</li>';
endforeach; 










	
}
else {
	
echo 'Only Content user can access this page';	
	
}
echo '<BR>';
echo '<BR>';
echo '<BR>';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/logout.inc.html.php';		
		
?>		
		



