twilio-chatwork-voice-message
=============================

Twilio で録音した電話音声を ChatWork へ送信するサンプル

@see URL

=============================

## Usage

```bash
$ git clone https://github.com/shin1x1/twilio-chatwork-voice-message.git
$ cd twilio-chatwork-voice-message

$ curl -sS https://getcomposer.org/installer | php
$ ./composer.phar install
```

config.json に設定を記載するので、config.json.default をコピーします。

```bash
$ cp -a config.json.default config.json
```

必要な設定は下記です。
* room_id: 録音時にメッセージが送信される ChatWork ルーム ID 
* api_token: ChatWork API トークン

```json
{
    "chatwork": {
        "room_id" : "your room id",
        "api_token": "your api token"
    }
}
```
