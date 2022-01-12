<?php require_once ROOT . "/resources/views/header.php"; ?>

<?php if ($is_seller) : ?>
  <h1>買い手の支払いが完了していません。</h1>
<?php else : ?>
  <h1>支払いが完了していません。</h1>
  <div>
    <p>商品名: </p>
    <p>値段: </p>
  </div>
  <form action='<?php echo "./${transactions['id']}/payments"; ?>' method="post">
    <div>
      <label for="method">支払い方法</label>
      <select name="method" id="method">
        <option value="0">カード支払い</option>
        <option value="1">コンビニ支払い</option>
        <option value="2">銀行支払い</option>
      </select>
    </div>
    <div>
      <label for="postcode">郵便番号</label>
      <input type="number" name="postcode" id="postcode" placeholder="1234567">
    </div>
    <div>
      <label for="prefecture">都道府県</label>
      <input type="text" name="prefecture" id="prefecture">
    </div>
    <div>
      <label for="city">市区町村</label>
      <input type="text" name="city" id="city">
    </div>
    <div>
      <label for="chomei">丁目・番地・号</label>
      <input type="text" name="chomei" id="chomei">
    </div>
    <div>
      <label for="building">建物名・会社名</label>
      <input type="text" name="building" id="building">
    </div>
    <div>
      <label for="room_number">部屋番号</label>
      <input type="text" name="room_number" id="room_number">
    </div>
    <div>
      <input type="submit" value="購入">
    </div>
  </form>
<?php endif; ?>