<?php
// replace with your url you got here : https://my.slack.com/services/new/incoming-webhook
$INCOMING_WEBHOOK_URL = "https://hooks.slack.com/services/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";

$USERNAME = "God has googled this for you.";
$ICON = ":godmode:";


$text = $_POST['text'];
$channel_name = $_POST['channel_name'];


$curl = curl_init($INCOMING_WEBHOOK_URL);
curl_setopt($curl, CURLOPT_POST, true);

$response = "http://lmgtfy.com/?q=".rawurlencode($text);

$payload = array(
    'text' => rawurlencode($response),
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
