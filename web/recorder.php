<?php
require_once __DIR__.'/../vendor/autoload.php';

// config
$config = json_decode(file_get_contents(__DIR__.'/../config.json'));

$twiml = new Services_Twilio_Twiml();

if (!empty($_POST['RecordingUrl'])) {
    $url = $_POST['RecordingUrl'];

    $tel = '';
    if (!empty($_GET['from'])) {
        $tel = ''.$_GET['from'];
    }

    $body = <<<EOT
    ボイスメッセージが来たよ！
[info]【電話番号】: ${tel} [hr]【URL】: ${url}[/info]
EOT;

    $opts = array(
        'http' => array(
            'method' => 'POST',
            'header' => "X-ChatWorkToken: " . $config->chatwork->api_token . "\r\n".
            "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query(array('body' => $body)),
        ),
    );

    $context = stream_context_create($opts);

    $endpoint = sprintf('https://api.chatwork.com/v1/rooms/%d/messages', $config->chatwork->room_id);
    $res = file_get_contents($endpoint, false, $context);
    if ($res) {
        $twiml->say('メッセージを送信しました。', array('language' => 'ja-JP'));
    }
}

$twiml->say('電話をお切り下さい。', array('language' => 'ja-JP'));

header('Content-Type: text/xml');
echo $twiml;
