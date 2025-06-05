<?php
require_once('config/cities.php');

// ✅ 東京を定義（固定表示）
$tokyo = $cities['tokyo'];

// ✅ チェックされた都市を抽出（tokyoは除外）
$selectedCities = [];
// $_GET はURLのパラメータを受け取る連想配列
foreach ($_GET as $id => $_) {
    // tokyoはスキップ
    if ($id === 'tokyo') continue;
    if (isset($cities[$id])) {
        // チェックしたidがconfigの$citiesにあれば$cities[$id] の都市情報を $selectedCitiesの 配列に追加
        $selectedCities[] = $cities[$id];
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>World Clock</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/result.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/php02/index.php">
                World Clock
            </a>
        </div>
    </header>

    <main>
        <div class="result__content">
            <div class="result-cards">

                <!--  東京（常に表示） -->
                <div class="result-card">
                    <div class="result-card__img-wrapper">
                        <img class="result-card__img" src="img/<?= $tokyo['img'] ?>" alt="東京">
                    </div>
                    <div class="result-card__body">
                        <p class="result-card__city"><?= ($tokyo['name']) ?></p>
                    </div>
                    <div>
                        <!-- custom data attribute で直接['tokyo']time zone を指定して時間表示 -->
                        <p class="result-card__time" data-timezone="<?= $tokyo['time_zone'] ?>"></p>
                    </div>
                </div>

                <!--  選択された都市（あれば表示） -->
                <?php if (empty($selectedCities)): ?>
                    <p style="text-align: center; margin-top: 40px;">他の都市は選択されていません。</p>
                <?php else: ?>
                    <!-- $selectedCities に入っている各都市（$cities[$id]）を 1 件ずつ取り出して $city に代入 -->
                    <?php foreach ($selectedCities as $city): ?>
                        <div class="result-card">
                            <div class="result-card__img-wrapper">
                                <img class="result-card__img" src="img/<?= $city['img'] ?>" alt="<?= $city['name'] ?>">
                            </div>
                            <div class="result-card__body">
                                <p class="result-card__city"><?= $city['name'] ?></p>
                            </div>
                            <div>
                                <!-- custom data attribute カスタム属性で直接['city']time zone を指定して時間表示 -->
                                <p class="result-card__time" data-timezone="<?= $city['time_zone'] ?>"></p>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>

        <div class="back-button" style="text-align: center; margin-top: 40px;">
            <a href="index.php" class="back-button__link">戻る</a>
        </div>
    </main>

    <!-- ✅ 時計表示スクリプト（/js/clock.jsが存在する前提） -->
    <script src="js/clock.js"></script>
</body>

</html>