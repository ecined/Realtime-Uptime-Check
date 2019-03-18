<?php
//Written by Denice Cabrera
//March 15, 2019

date_default_timezone_set('America/Los_Angeles');
$date = date("m/d/Y");
$time = date("h:i:sa");

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Realtime Uptime Check</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
</head>
<body>

<div class='container'>
  <h2>Realtime Uptime Check</h2>
  <p>This is a realtime tool that uses PHP and HTML to check and output uptime results for multiple URLs.</p>
  <table class='table table-dark table-hover'>
    <thead>
      <tr>
        <th>Company</th>
        <th>URL</th>
        <th>Results</th>
        <th>HTTP Status Code</th>
      </tr>
    </thead>
    <tbody>";
$arr = array("Instagram"=>"https://www.instagram.com", "Facebook"=>"https://www.facebook.com", "Google"=>"https://www.google.com", "Yelp"=>"https://www.yelp.com");
foreach ($arr as $company => $url)
	{ 
		$ch = curl_init($url);
		$up = 'Up';
		$down = 'Down';
		$redirect = 'Redirect';
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		echo "<tr>";
 		echo "<td>"; 
 		echo $company;
 		echo "</td>";
 		echo "<td>";
 		echo "<a href='"; echo $url; echo "' target='new'>"; echo $url; echo "</a>";
 		echo "</td>";
 		echo "<td>";
 		if($httpcode>=200 && $httpcode<=300){
  			echo "<font color = 'green'>"; echo $up; echo "</font></td>";
  			echo "<td>"; echo $httpcode; echo "</td>";
  		} else if ($httpcode>=300){
   			echo "<font color = 'yellow'>"; echo $redirect; echo "</font></td>";
  			echo "<td>"; echo $httpcode; echo "</td>"; 			
		} else {
 		 	echo "<font color = 'red'>"; echo $down; echo "</font></td>";
 		 	echo "<td>"; echo $httpcode; echo "</td>";

 		}
 		echo "</td>";
 		echo "</tr>";
 	}
 echo "</tbody>
 	</table>
  Updated On -<br>
  <b>Date:</b> "; echo $date; 
  echo "<br><b>Time: </b>"; echo $time;
 echo " 
 </div>
 </body>
 </html>";

?>