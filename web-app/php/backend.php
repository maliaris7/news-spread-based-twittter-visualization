<?php

//create the json data by calling the createJson function with the news corporation twitter handle in string form without the @
//notice that prior to that you have to run the createDB.php script and manually insert the handle (again without the @) and the corresponding 
//longitude and latitude of the said news corporation Headquarters.
//and change the bearer token in the twitter_req function (get it by runing the oauth.php included notice the you have to change the credencials in the oauth script)
set_time_limit (0);

createJson('CNN');

function twitter_req($API_query,$api_URL){
	

$bearertok = "************************************************************************";//change it to your bearer token

$ch = curl_init();
$headers = array( 
    "Authorization: Bearer $bearertok"
  ); 
  
  curl_setopt($ch, CURLOPT_URL, "$api_URL"."$API_query");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, " di.ionio.gr Application / mailto:p11anni@ionio.gr ");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $data = curl_exec($ch);
  if(curl_exec($ch) === false)
				{
					echo 'Curl error: ' . curl_error($ch);//ERROR CHECKING
				}
  $info = curl_getinfo($ch); 
  $http_code = $info['http_code'];//print_r($http_code); FOR DEBUG TO HTTP HEADERS
  curl_close($ch);//CLOSING CURL
  $json = json_decode($data, true);//decoding json from twitter 
  return $json;

}

function MRtweet($name){

	$api_URL = 'https://api.twitter.com/1.1/search/tweets.json';
	$API_query = '?q=@'. $name . '&result_type=popular&result_type=recent&count=10';
	
	$json = twitter_req($API_query,$api_URL);
	  
	$max_rtweet_count = 0;
	  
	  foreach ($json["statuses"] as $tweet) {
		   
		   if( $tweet["retweet_count"]>$max_rtweet_count){
				$tweet_id = $tweet["id_str"];
				$max_rtweet_count = $tweet["retweet_count"];
		   }
				
		}
		

		return $tweet_id;
			
	}	

function createJson($name){
$tweet_id = MRtweet($name);

$api_URL = 'https://api.twitter.com/1.1/statuses/retweeters/ids.json';
$API_query = '?id=' . $tweet_id . '&count=25&stringify_ids=true';

  $json = twitter_req($API_query,$api_URL);
  
  $json_arr = array();
  
  foreach( $json["ids"] as $id ){
  
  $temp_arr = UserLocation($id,$name);
  $json_arr [] = $temp_arr;
  
  }
  $fp = fopen($name.'.json', 'w');
  fwrite($fp, json_encode($json_arr));
  fclose($fp);
  echo json_encode($json_arr);
}
  
function UserLocation($id,$name){

	$api_URL = 'https://api.twitter.com/1.1/users/show.json';
	$API_query = '?user_id=' . $id;
	
	  $json = twitter_req($API_query,$api_URL);
	  $location = $json["location"];
	  $location = trim(str_replace(range(0,9),'',$location));
	  $location = preg_replace('/[^A-Za-z0-9\-]/', ' ', $location); // Removes special chars.
	  $location = preg_replace('/\s+/', ' ',$location);
	  if(strcmp($location,'') != 0){
	  $temp_arr = fetchCoor($name);
	  $loc_arr = array("tweet_id" => $id , "name" => $name , "location" => $location , "lat" => $temp_arr['lat'] , "long" => $temp_arr['long'] );
	  return $loc_arr;
	  }
	}
	
function fetchCoor($name){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn,"SELECT `lat` , `lng` FROM `latlong` WHERE name = '".$name."'");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $temp_arr = array ( "lat" => $row["lat"] , "long" => $row["lng"]);
    }
} 

$conn->close();

return  $temp_arr;

}	
	
?>