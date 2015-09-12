<?php

$INCOMING_WEBHOOK_URL = "https://hooks.slack.com/services/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";

$bitly_url = "https://api-ssl.bitly.com/v3/shorten?";

$BITLY_AUTH_TOKEN = "7eca854a2d6ce5a69ec3f8ef232565ae15c31615";

$BITLY_RETURN_FORMAT = 'txt';

$USERNAME = "God";

$ICON = ":godmode:";

$BOTNAME = 'God Says';

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


$payload  = array(
			'text' => $shortened_url,
			'icon_emoji' => $ICON,
			'username' => $USERNAME,
		    'channel' => "#".$channel_name,
		    'new-bot-name' => $BOTNAME,
		    'unfurl_links' => true,
		);

$jsonPayload = json_encode($payload, JSON_PRETTY_PRINT);

//exit('payload='.$jsonPayload);

curl_setopt($curl, CURLOPT_POSTFIELDS, 'payload='.$jsonPayload);

$return = curl_exec($curl);
curl_close($curl);

/*
$payload = array(
	'attachments' => array(
		array(
		    'username' => $USERNAME,
		    'channel' => "#".$channel_name,
		    'new-bot-name' => $BOTNAME,
		    'unfurl_links' => true,
			'color' => '#0099CC',
			'fallback' => 'This is a test',
			'pretext' => 'This is pretext',
			'fields' => array(array(
				'title' => 'God Has Answered',
					'value' => $shortened_url,
					'short' => true,
					'icon_emoji' => $ICON,
					
					)
				)
		)
	)
);
*/
?>