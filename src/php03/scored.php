<?php
session_start(); // セッションを開始（スコアや問題履歴を読み出すため）

// ============================
// 得点関連の情報を取得
// ============================
$score = $_SESSION['score'] ?? 0;                         // 現在のスコア（未定義なら0）
$total_questions = $_SESSION['total_questions'] ?? 10;   // 出題数（未定義なら10問）
$max_score = $total_questions * 10;                       // 最大スコア（各問10点）

// ============================
// 出題された問題とユーザーの回答履歴を取得
// ============================
$questions = $_SESSION['questions'] ?? [];
$user_answers = $_SESSION['user_answers'] ?? [];

// ============================
// クッキーから過去の履歴を読み出し
// ============================
$history = [];
if (isset($_COOKIE['score_history'])) {
    $history = json_decode($_COOKIE['score_history'], true);
}

        // ============================
        // 今回のスコアを履歴の先頭に追加　array_unshift --配列の先頭に要素を追加する PHP の関数
        // ============================
        array_unshift($history, [
    'score' => $score,
    'max'   => $max_score,
    'date'  => date('Y/m/d H:i:s')
]);

// 履歴は最大10件までに制限して保存（古いものは削除）
$history = array_slice($history, 0, 10);
setcookie('score_history', json_encode($history), time() + 60 * 60 * 24 * 7); // クッキーに1週間保存

// ============================
// 問題と回答のセッション情報を削除（scoreは残す）
// ============================
unset($_SESSION['questions']);
unset($_SESSION['user_answers']);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>クイズ結果</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/scored.css">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/php03">Status Code Quiz</a>
        </div>
    </header>

    <main class="quiz__content" style="text-align: center;">
        <!-- スコア概要の表示 -->
        <h2>あなたの点数：<?php echo $score; ?> / <?php echo $max_score; ?> 点</h2>
        <p>正解数：<?php echo $score / 10; ?> / <?php echo $total_questions; ?> 問</p>

        <!-- 問題ごとの正誤一覧テーブル -->
        <?php if (!empty($questions) && !empty($user_answers)): ?>
            <div class="result-table-box">
                <h3>出題された問題と正誤</h3>
                <table class="result-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>問題文</th>
                            <th>あなたの答え</th>
                            <th>正解</th>
                            <th>判定</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($questions); $i++): ?>
                            <?php
                            $q = $questions[$i];
                            $userAnswer = $user_answers[$i];
                            $correctCode = $q['code'];
                            $correctMeaning = $q['meaning'];
                            $isCorrect = ((string)$userAnswer === (string)$correctCode);
                            ?>
                            <tr>
                                <!-- 問題番号（1問目〜） -->
                                <td><?= '#' . ($i + 1) . '問目' ?></td>
                                <!-- 問題文 -->
                                <td><?= htmlspecialchars($q['description']) ?></td>
                                <!-- ユーザーの選択 -->
                                <td><?= htmlspecialchars($userAnswer) ?></td>
                                <!-- 正解と意味 -->
                                <td><?= htmlspecialchars("{$correctCode} - {$correctMeaning}") ?></td>
                                <!-- 判定アイコンとスタイル -->
                                <td class="<?= $isCorrect ? 'correct' : 'incorrect' ?>" style="text-align: center; font-weight: bold;">
                                    <?= $isCorrect ? '〇' : '×' ?>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <!-- 最近の履歴（最大10件） -->
        <?php if (!empty($history)): ?>
            <div class="history-box">
                <h3>最近の履歴（最大10件）</h3>
                <ul>
                    <?php foreach ($history as $entry): ?>
                        <li>
                            <?php echo htmlspecialchars($entry['date']); ?>：
                            <?php echo $entry['score']; ?> / <?php echo $entry['max']; ?> 点
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- リトライボタン -->
        <form action="functions/retry.php" method="post" style="margin-top: 40px;">
            <button class="quiz-form__button-submit" type="submit">リトライ</button>
        </form>
    </main>
</body>

</html>