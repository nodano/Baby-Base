<?php

/**
 * コントローラー内で、$this->view()の第2引数で与えられた配列を扱うことができます。
 *  例: "~~~.php", [products => $result] -> $productsで$resultの値を取得可能
 * 
 * グローバル値
 *  $auth['is_login'] = boolean
 *  $auth['user] = Auth\User\LoginUser | false
 */
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baby-Base</title>
    <link rel="stylesheet" href="<?php echo ASSETS_URL . 'css/style.css'; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <?php
    // echo "↓ header.php <br><pre>";
    // var_dump($_SESSION);
    // echo "</pre><br>";
    ?>
    <header class="header">
        <div class="header-bar">
            <div class="header-hamburger-container hamburger-container">
                <div class="hamburger hamburger-trigger" data-hamburger-target="hamburger-container" data-hamburger-class="is-open">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="hamburger-menu">
                    <div>
                        <form action="#" method="get" class="form">
                            <div class="search-container">
                                <input type="text" name="search" id="search" class="form-input search">
                                <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <div>カテゴリー~~~</div>
                        <div>性別から~~~</div>
                    </div>
                    <div class="grid-container">
                        <p class="grid-headline">ご利用ガイド</p>
                        <div class="grid-wrap">
                            <div class="grid">
                                <i class="fas fa-shopping-cart t-center"></i>
                                <p class="grid-text">ご注文について</p>
                            </div>
                            <div class="grid">
                                <i class="fas fa-truck t-center"></i>
                                <p class="grid-text">配送について</p>
                            </div>
                            <div class="grid">
                                <i class="far fa-id-card t-center"></i>
                                <p class="grid-text">会員について</p>
                            </div>
                            <div class="grid">
                                <i class="fas fa-tape t-center"></i>
                                <p class="grid-text">サイズについて</p>
                            </div>
                            <div class="grid">
                                <i class="fas fa-ticket-alt t-center"></i>
                                <p class="grid-text">クーポンについて</p>
                            </div>
                            <div class="grid">
                                <i class="fas fa-question-circle t-center"></i>
                                <p class="grid-text">お問い合わせ</p>
                            </div>
                            <div class="grid">
                                <i class="fab fa-quora t-center"></i>
                                <p class="grid-text">よくある質問</p>
                            </div>
                        </div>
                    </div>
                </nav><!-- .hamburger-menu -->
            </div><!-- .hamburger-container -->

            <div class="header-logo">
                <h1>
                    <a href="<?php echo PUBLIC_URL; ?>">
                        <img src="<?php echo ASSETS_URL . 'images/logo.jpg'; ?>" alt="Baby-Base Logo">
                    </a>
                </h1>
            </div><!-- .header-logo -->

            <nav class="header-navigation">
                <ul class="header-navigation-list">
                    <?php if ($auth['is_login']) : ?>
                        <li class="header-navigation-item">
                            <a href="<?php echo PUBLIC_URL . "auth/logout" ?>" class="header-navigation-link">ログアウト</a>
                        </li>
                        <li class="header-navigation-item">
                            <a href="<?php echo PUBLIC_URL . "listing" ?>" class="button button-small">出品</a>
                        </li>
                    <?php else : ?>
                        <li class="header-navigation-item">
                            <a href="<?php echo PUBLIC_URL . "auth/signup" ?>" class="header-navigation-link">会員登録</a>
                        </li>
                        <li class="header-navigation-item">
                            <a href="<?php echo PUBLIC_URL . "auth/login" ?>" class="header-navigation-link">ログイン</a>
                        </li>
                        <li class="header-navigation-item">
                            <a href="<?php echo PUBLIC_URL . "listing" ?>" class="button button-small">出品</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div><!-- .header-bar -->
    </header>

    <main class="main">
        <ul>
            <li><a href="<?php echo PUBLIC_URL . "" ?>">TOP</a></li>
            <li><a href="<?php echo PUBLIC_URL . "auth/signup" ?>">サインアップ</a></li>
            <li><a href="<?php echo PUBLIC_URL . "auth/login" ?>">ログイン</a></li>
            <li><a href="<?php echo PUBLIC_URL . "auth/logout" ?>">ログアウト</a></li>
            <li><a href="<?php echo PUBLIC_URL . "users/2" ?>">ユーザーID: 2のページ</a></li>
            <li><a href="<?php echo PUBLIC_URL . "mypage" ?>">マイページ</a></li>
            <li><a href="<?php echo PUBLIC_URL . "mypage/info" ?>">ユーザー情報</a></li>
            <li><a href="<?php echo PUBLIC_URL . "mypage/profit" ?>">売上確認</a></li>
            <li><a href="<?php echo PUBLIC_URL . "mypage/favorite" ?>">お気に入り</a></li>
            <li><a href="<?php echo PUBLIC_URL . "mypage/block" ?>">ブロック</a></li>
            <li><a href="<?php echo PUBLIC_URL . "listing" ?>">出品</a></li>
            <li><a href="<?php echo PUBLIC_URL . "products" ?>">商品一覧</a></li>
            <li><a href="<?php echo PUBLIC_URL . "products/6" ?>">商品ID: 6の商品詳細</a></li>
            <li><a href="<?php echo PUBLIC_URL . "products/3/update" ?>">商品ID: 3の商品更新</a></li>
            <li><a href="<?php echo PUBLIC_URL . "transactions/4" ?>">取引ID: 4の取引画面</a></li>
        </ul>