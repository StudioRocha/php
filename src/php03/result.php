<?php
session_start(); // セッションを開始（前回の正解データやスコアを使う）

require_once('config/status_codes.php'); // ステータスコード一覧を読み込む

// =============================
// フォームから送信された選択肢（'option'）を取得
// 正解コード（事前にindex.phpで保存された）をセッションから取得
// =============================
$selected = $_POST['option'] ?? '';                // ユーザーの選んだ答え（選択肢のvalue）
$correct = $_SESSION['answer_code'] ?? '';         // 正解のステータスコード

// =============================
// 正誤判定を行う（文字列として比較）
// =============================
$result = ($selected === $correct);

// =============================
// スコアを初期化（なければ）し、正解時に10点加算
// =============================
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if ($result) {
    $_SESSION['score'] += 10;
}

// =============================
// 選択肢のコードに対応する詳細（説明・意味）を探す
// =============================
$code = '';
$description = '';
$meaning = '';
foreach ($status_codes as $status) {
    if ($status['code'] == $correct) {
        $code = $status['code'];
        $description = $status['description'];
        $meaning = $status['meaning'] ?? '';
        break;
    }
}

// =============================
// 出題履歴とユーザーの回答履歴をセッションに保存
// 初回アクセス時に初期化
// =============================
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = [];
}
if (!isset($_SESSION['user_answers'])) {
    $_SESSION['user_answers'] = [];
}

// 現在の問題と回答を記録に追加
$_SESSION['questions'][] = [
    'description' => $description,
    'code' => (string)$code,
    'meaning' => $meaning,
];
$_SESSION['user_answers'][] = (string)$selected;

// =============================
// すでに10問出題済みなら、scored.php へリダイレクト
// =============================
if (count($_SESSION['used_codes']) >= 10) {
    header('Location: scored.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>回答結果</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/result.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/php03">Status Code Quiz</a>
        </div>
    </header>

    <main>
        <div class="result__content">
            <div class="result">
                <!-- 正誤によって表示を分岐 -->
                <?php if ($result): ?>
                    <h2 class="result__text--correct">正解</h2>
                <?php else: ?>
                    <h2 class="result__text--incorrect">不正解</h2>
                <?php endif; ?>
            </div>

            <!-- 正解コードと説明をテーブルで表示 -->
            <div class="answer-table">
                <table class="answer-table__inner">
                    <tr class="answer-table__row">
                        <th class="answer-table__header">ステータスコード</th>
                        <td class="answer-table__text"><?php echo $code; ?></td>
                    </tr>
                    <tr class="answer-table__row">
                        <th class="answer-table__header">説明</th>
                        <td class="answer-table__text"><?php echo $description; ?></td>
                    </tr>
                </table>
            </div>

            <!-- 「次の問題へ」ボタン（POSTでindex.phpに遷移） -->
            <div class="next-button-wrapper">
                <form method="post" action="index.php">
                    <button class="quiz-form__button-submit" type="submit">次の問題へ</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>