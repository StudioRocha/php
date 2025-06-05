<?php

function searchCityTime($city_name)
{
    // 都市情報の一覧が定義されたファイルを読み込む
    require('config/cities.php');

    // $cities 配列の中から、1つずつ都市情報を取り出して調べる
    foreach ($cities as $city) {
        // 引数で渡された都市名と一致するものを探す
        // 厳密比較演算子===
        if ($city['name'] === $city_name) {

            // 該当都市のタイムゾーンで現在時刻を取得
            $date_time = new DateTime('', new DateTimeZone($city['time_zone']));

            // ２回インスタンスを生成して入れ子にしてる$timezone = new DateTimeZone($city['time_zone']); // タイムゾーン指定
            // $date_time = new DateTime('', $timezone);

            // そのタイムゾーンで現在時刻
            //第一引数に空文字 '' を渡すと、「今（= 現在時刻）」という意味


            // 時刻を「時:分」形式（例：14:30）で整形. 　->はアクセス演算子
            $time = $date_time->format('H:i');
            $city['time'] = $time;
            // 都市情報に現在時刻を追加
            // $city = [
            //     'name' => '東京',
            //     'time_zone' => 'Asia/Tokyo',
            //     'img' => 'japan.jpg',
            //     'time' => '14:30'  // ← これが追加された！
            // ];

            // $city = [
            //     'name' => '東京',
            //     'time_zone' => 'Asia/Tokyo',
            //     'img' => 'japan.jpg',
            //     'time' => '14:30'  // ← これが追加された！
            // ];

            // 都市情報（名前・タイムゾーン・画像・現在時刻）を返す

            return $city;
        }
    }

    // 一致する都市が見つからなかった場合は何も返さない（null）
}
