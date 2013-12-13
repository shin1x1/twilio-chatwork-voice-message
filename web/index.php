<?php
require_once __DIR__.'/../vendor/autoload.php';

$twiml = new Services_Twilio_Twiml();

if (!empty($_POST['From'])) {
    $twiml->say('こんにちは！ピー、、、という音の後にメッセージをどうぞ。終了する場合はシャープを押して下さい。', array('language' => 'ja-JP'));
    $twiml->record(array(
        'action' => 'recorder.php?from='.urlencode($_POST['From']),
        'finishOnKey' => '#',
        'maxLength' => 600,
    ));

} else {
    $twiml->say('電話をお切り下さい。', array('language' => 'ja-JP'));
}

header('Content-Type: text/xml');
echo $twiml;
