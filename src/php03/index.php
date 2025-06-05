<?php
session_start(); // セッション開始（クイズ状態の保持に使用）
require_once('config/status_codes.php'); // ステータスコード一覧を読み込み

// =============================
// 出題設定：常に10問出す
// =============================
define('TOTAL_QUESTIONS', 10);

// =============================
// クイズ開始時（1回目アクセス時）に出題データを初期化
// =============================
if (!isset($_SESSION['question_pool'])) {
    shuffle($status_codes); // 全体をシャッフル
    $_SESSION['question_pool'] = array_slice($status_codes, 0, TOTAL_QUESTIONS); // 10問抽出
    $_SESSION['used_codes'] = []; // 出題済みコードの履歴
    $_SESSION['score'] = 0;       // スコア初期化
}

// =============================
// 現在の問題インデックス（1〜10）
// =============================
$current_index = count($_SESSION['used_codes']) + 1;

// =============================
// 10問を超えたら結果画面にリダイレクト
// =============================
if ($current_index > TOTAL_QUESTIONS) {
    header('Location: scored.php');
    exit;
}

// =============================
// 現在出題する問題（正解の1問）を取得
// =============================
$question = $_SESSION['question_pool'][$current_index - 1];
$_SESSION['used_codes'][] = $question['code']; // 出題済みコードとして保存

// =============================
// 他の問題から「誤答候補」をランダムに3つ取得
// =============================
$other_options = array_filter($_SESSION['question_pool'], function ($item) use ($question) {
    return $item['code'] !== $question['code']; // 正解以外を抽出
});
shuffle($other_options);
$wrong_choices = array_slice($other_options, 0, 3);

// =============================
// 正解と誤答候補をまとめてシャッフル
// =============================
$options = array_merge($wrong_choices, [$question]);
shuffle($options);

// =============================
// 正解コードをセッションに保存（result.phpで使う）
// =============================
$_SESSION['answer_code'] = $question['code'];
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Code Quiz</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <!-- ロゴリンク -->
            <a class="header__logo" href="/php03">Status Code Quiz</a>
        </div>
    </header>

    <main>
        <div class="quiz__content">
            <!-- 問題番号の表示 -->
            <p class="question__number">【第 <?php echo $current_index; ?> 問】</p>

            <!-- 問題文の表示 -->
            <div class="question">
                <p class="question__text">Q. 以下の内容に当てはまるステータスコードを選んでください</p>
                <p class="question__text"><?php echo $question['description']; ?></p>
            </div>

            <!-- 回答フォーム -->
            <form class="quiz-form" action="result.php" method="post">
                <!-- 正解コードを hidden フィールドで送信（※保険的に、現在は不要でも） -->
                <input type="hidden" name="answer_code" value="<?php echo $question['code']; ?>">

                <div class="quiz-form__item">
                    <!-- 選択肢の表示（シャッフル済み） -->
                    <?php foreach ($options as $option): ?>
                        <div class="quiz-form__group">
                            <input class="quiz-form__radio"
                                id="<?php echo $option['code']; ?>"
                                type="radio" name="option"
                                value="<?php echo $option['code']; ?>">
                            <label class="quiz-form__label"
                                for="<?php echo $option['code']; ?>">
                                <?php echo $option['code']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- 送信ボタン -->
                <div class="quiz-form__button">
                    <button class="quiz-form__button-submit" type="submit">回答</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Debugログ（開発時のみ表示） -->
    <pre style="margin: 40px; background: #eee; padding: 10px;">
    <?php
    echo "現在の問題:\n";
    print_r($question);
    ?>
    </pre>
</body>

</html>