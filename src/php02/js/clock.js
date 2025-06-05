// 時計を更新する関数を定義（毎秒呼び出される）
function updateClocks() {

    // ページ内のすべての .result-card__time 要素を取得（都市の時間表示用）
    const clocks = document.querySelectorAll('.result-card__time');

    // 取得した各要素に対して1つずつ処理を行う
    clocks.forEach(clock => {

        // data-timezone 属性からタイムゾーン情報を取得（例: "Asia/Tokyo"）
        const tz = clock.dataset.timezone;

        // 現在のPC時刻（UTCではない）を取得
        const now = new Date();

        // Intl.DateTimeFormat を使って日付・時刻をフォーマット
        const formatter = new Intl.DateTimeFormat('ja-JP', {
            // year: 'numeric',      // 年（例: 2024）
            month: '2-digit',     // 月（例: 05）
            day: '2-digit',       // 日（例: 14）
            hour: '2-digit',      // 時（例: 14）
            minute: '2-digit',    // 分（例: 30）
            second: '2-digit',    // 秒（例: 01）
            timeZone: tz,         // 表示対象の都市のタイムゾーンを指定
            hour12: false         // 24時間表記にする（trueにするとAM/PM形式）
        });

        // 整形した日時を、対象のHTML要素のテキストとして表示する
        clock.textContent = formatter.format(now);
    });
}

// ページ読み込み時にすぐ1回、時刻を表示
updateClocks();

// 1秒ごとに updateClocks を実行（リアルタイム更新）
setInterval(updateClocks, 1000);
