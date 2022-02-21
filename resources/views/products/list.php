<h1>商品一覧</h1>

<form action="" method="get">
    <select name="sort">
        <option value="">選択してください</option>
        <option value="priceDesc">価格高い順</option>
        <option value="priceAsc">価格安い順</option>
        <option value="idDesc">最新商品</option>
        <option value="idAsc">最古商品</option>
    </select>
    <input type="submit" value="送信">
</form>
<form action="" method="get">
    <input type="text" name="search">
    <input type="submit" value="検索">
</form>
<pre>
<?php
var_dump($products);
?>
</pre>