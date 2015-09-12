<?php

$INCOMING_WEBHOOK_URL = "https://hooks.slack.com/services/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";

$bitly_url = "https://api-ssl.bitly.com/v3/shorten?";

$BITLY_AUTH_TOKEN = "7eca854a2d6ce5a69ec3f8ef232565ae15c31615";

$BITLY_RETURN_FORMAT = 'txt';

$USERNAME = "God has googled this for you.";

$ICON = ":godmode:";

$text 			= $_REQUEST['text'];
$channel_name 	= $_REQUEST['channel_name'];

$long_url = "http://lmgtfy.com/?q=".rawurlencode($text);

/** BITLY URL SHORTENER REQUEST **/
$parameters = array(
		'access_token'  => $BITLY_AUTH_TOKEN,
		'format'		=> $BITLY_RETURN_FORMAT,
		'longUrl'		=> $long_url
	);


$url = "$bitly_url".http_build_query($parameters);

$shortened_url = file_get_contents($url);

/** SLACK WEBHOOK REQUEST **/
$curl = curl_init($INCOMING_WEBHOOK_URL);

curl_setopt($curl, CURLOPT_POST, true);

$payload = array(
    'text' => rawurlencode($shortened_url),
    'username' => $USERNAME,
    'icon_emoji' => $ICON,
    'channel' => "#".$channel_name,
    'unfurl_links' => 'true'
);

$jsonPayload = "payload=".json_encode($payload);

curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonPayload);

$return = curl_exec($curl);
curl_close($curl);
?>
