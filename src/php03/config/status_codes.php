<?php

// $test = [1, 2, 3, 4, 5];
// $result = array_rand($test);
// var_dump($result); // 確認用コード

$status_codes = [
  [
    'code' => '102',
    'meaning' => 'Processing',
    'description' => '処理中である'
  ],
  [
    'code' => '200',
    'meaning' => 'OK',
    'description' => 'リクエストが正常に成功できた'
  ],
  [
    'code' => '301',
    'meaning' => 'Moved Permanently',
    'description' => 'リクエストしたリソースが恒久的に移動されている'
  ],
  [
    'code' => '304',
    'meaning' => 'Not Modified',
    'description' => 'リクエストしたリソースは更新されていない'
  ],
  [
    'code' => '400',
    'meaning' => 'Bad Request',
    'description' => 'クライアントのリクエストに異常がある'
  ],
  [
    'code' => '401',
    'meaning' => 'Unauthorized',
    'description' => 'アクセストークンが無効なときや、認証がされていない'
  ],
  [
    'code' => '403',
    'meaning' => 'Forbidden',
    'description' => '閲覧権限が無いファイルやフォルダである'
  ],
  [
    'code' => '404',
    'meaning' => 'Not found',
    'description' => 'Webページが見つからない'
  ],
  [
    'code' => '500',
    'meaning' => 'Internal Server Error',
    'description' => '何らかのサーバ内でエラーが起きた'
  ],
  [
    'code' => '502',
    'meaning' => 'Bad Gateway',
    'description' => 'サーバーがリクエストに満たすのに必要な機能をサポートしていない'
  ],
  [
    'code' => '503',
    'meaning' => 'Service Unavailable',
    'description' => '一時的にサーバにアクセスが出来ない'
  ],
  [
    'code' => '201',
    'meaning' => 'Created',
    'description' => 'リクエストが成功し、新しいリソースが作成された'
  ],
  [
    'code' => '204',
    'meaning' => 'No Content',
    'description' => '成功しているが、返すコンテンツが存在しない'
  ],
  [
    'code' => '307',
    'meaning' => 'Temporary Redirect',
    'description' => '一時的に別のURIにリクエストを送る必要がある'
  ],
  [
    'code' => '308',
    'meaning' => 'Permanent Redirect',
    'description' => '恒久的に別のURIに移動した（POSTもそのまま転送）'
  ],
  [
    'code' => '405',
    'meaning' => 'Method Not Allowed',
    'description' => '許可されていないHTTPメソッドが使用された'
  ],
  [
    'code' => '408',
    'meaning' => 'Request Timeout',
    'description' => 'クライアントのリクエストがタイムアウトした'
  ],
  [
    'code' => '429',
    'meaning' => 'Too Many Requests',
    'description' => '一定時間に送信されたリクエストが多すぎる'
  ],
  [
    'code' => '504',
    'meaning' => 'Gateway Timeout',
    'description' => 'ゲートウェイまたはプロキシで応答が遅延した'
  ],
  [
    'code' => '511',
    'meaning' => 'Network Authentication Required',
    'description' => 'ネットワークアクセスに認証が必要'
  ]
];
