<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Clock</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
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
        <div class="search-form__content">
            <div class="search-form__heading">
                <h2>日本と世界の時間を比較</h2>
            </div>

            <!-- method="get" → データは URL に付けて送られる -->
            <form class="search-form" action="result.php" method="get">
                <div class="search-form__item">
                    <div class="search-form__item-checkbox">
                        <div>
                            <input type="checkbox" name="sydney" id="sydney">
                            <label for="sydney">シドニー</label>
                        </div>
                        <div>
                            <input type="checkbox" name="shanghai" id="shanghai">
                            <label for="shanghai">上海</label>
                        </div>
                        <div>
                            <input type="checkbox" name="moscow" id="moscow">
                            <label for="moscow">モスクワ</label>
                        </div>
                        <div>
                            <input type="checkbox" name="london" id="london">
                            <label for="london">ロンドン</label>
                        </div>
                        <div>
                            <input type="checkbox" name="johannesburg" id="johannesburg">
                            <label for="johannesburg">ヨハネスブルグ</label>
                        </div>
                        <div>
                            <input type="checkbox" name="new-york" id="new-york">
                            <label for="new-york">ニューヨーク</label>
                        </div>
                    </div>
                </div>

                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">
                        検索
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>