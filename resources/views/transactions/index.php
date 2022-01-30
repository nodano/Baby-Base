<?php if ($is_seller) : ?>
  <h1>買い手の支払いが完了していません。</h1>
<?php else : ?>
  <h1>支払いが完了していません。</h1>
  <div>
    <p>商品名: </p>
    <p>値段: </p>
  </div>
  <form action='<?php echo "./${transactions['id']}/payments"; ?>' method="post" class="form">

    <fieldset class="form-fieldset">
      <legend class="form-fieldset-legend">決済</legend>

      <div class="form-item">
        <div class="form-item-label">
          <label for="method">支払い方法</label>
        </div>
        <div class="form-item-control">
          <select name="method" id="method" class="form-item-input">
            <option value="0">カード支払い</option>
            <option value="1">コンビニ支払い</option>
            <option value="2">銀行支払い</option>
          </select>
        </div>
      </div>

    </fieldset>

    <fieldset class="form-fieldset">
      <legend class="form-fieldset-legend">配送先住所</legend>

      <div class="form-item">
        <div class="form-item-label">
          <label for="postcode">郵便番号</label>
        </div>
        <div class="form-item-control">
          <input type="number" name="postcode" id="postcode" class="form-item-input" placeholder="1234567" value="<?php if (isset($address['postcode'])) echo $address['postcode']; ?>">
        </div>
      </div>

      <div class="form-item">
        <div class="form-item-label">
          <label for="prefecture">都道府県</label>
        </div>
        <div class="form-item-control">
          <input type="text" name="prefecture" id="prefecture" class="form-item-input" value="<?php if (isset($address['prefecture'])) echo $address['prefecture']; ?>">
        </div>
      </div>

      <div class="form-item">
        <div class="form-item-label">
          <label for="city">市区町村</label>
        </div>
        <div class="form-item-control">
          <input type="text" name="city" id="city" class="form-item-input" value="<?php if (isset($address['city'])) echo $address['city']; ?>">
        </div>
      </div>

      <div class="form-item">
        <div class="form-item-label">
          <label for="chomei">丁目・番地・号</label>
        </div>
        <div class="form-item-control">
          <input type="text" name="chomei" id="chomei" class="form-item-input" value="<?php if (isset($address['chomei'])) echo $address['chomei']; ?>">
        </div>
      </div>

      <div class="form-item">
        <div class="form-item-label">
          <label for="building">建物名・会社名</label>
        </div>
        <div class="form-item-control">
          <input type="text" name="building" id="building" class="form-item-input" value="<?php if (isset($address['building'])) echo $address['building']; ?>">
        </div>
      </div>

      <div class="form-item">
        <div class="form-item-label">
          <label for="room_number">部屋番号</label>
        </div>
        <div class="form-item-control">
          <input type="text" name="room_number" id="room_number" class="form-item-input" value="<?php if (isset($address['room_number'])) echo $address['room_number']; ?>">
        </div>
      </div>

    </fieldset>

    <div class="form-item">
      <input type="submit" value="購入の確定" class="button form-submit">
    </div>
  </form>
<?php endif; ?>