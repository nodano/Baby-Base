<h1 class="t-center">取引画面</h1>

<div class="transaction">
  <p class="transaction-headline">商品情報</p>
  <div class="transaction-info">
    <h2 class="transaction-name"><a href="<?php echo Util::h(PUBLIC_URL . "products/" . $product['id']); ?>"><?php echo Util::h($product['name']); ?></a></h2>
    <p class="transaction-price"><span>商品代金:</span> &yen; <?php echo Util::h(number_format($product['price'])); ?></p>
    <p class="transaction-date"><span>購入日時:</span> <?php echo Util::h($transactions['purchase_date']); ?></p>
  </div>
</div>

<div class="chat">
  <div class="chat-wrap">
    <ul class="chat-list">
    </ul>
  </div>
  <div class="chat-form">
    <input type="text" name="comment" id="comment" class="form-item-input">
    <button class="chat-button" id="chat-button"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<script src="<?php echo ASSETS_URL . "js/firebaseConfig.js"; ?>"></script>
<script type="module">
  import {
    initializeApp
  } from "https://www.gstatic.com/firebasejs/9.6.7/firebase-app.js";
  import {
    getAnalytics
  } from "https://www.gstatic.com/firebasejs/9.6.7/firebase-analytics.js";
  import {
    getFirestore,
    collection,
    addDoc,
    getDocs,
    query,
    where,
    onSnapshot,
    doc,
    orderBy,
    serverTimestamp
  } from "https://www.gstatic.com/firebasejs/9.6.7/firebase-firestore.js";

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  const db = getFirestore();

  const url = "http://localhost/Baby-Base/api/loginCheck.php"; // URLの修正
  const getUserInfo = async () => {
    const response = await fetch(url);
    const data = await response.json();

    if (data.status === "OK") {
      return data.id;
    } else {
      return -1;
    }
  }
  const registerFirebase = async (id) => {
    // transaction_idの取得
    const pathname = location.pathname;
    const result = pathname.match(/([^\/.]+)/g);

    const transaction_id = Number(result[result.length - 1]);

    const comment = document.querySelector("#comment").value
    // firebaseに送信
    const data = {
      user_id: id,
      transaction_id,
      comment,
      timestamp: serverTimestamp(),
    }
    addDoc(collection(db, "comments"), data);
    document.querySelector("#comment").value = ""
  }

  const registerComment = async () => {
    const id = await getUserInfo();
    if (id) {
      await registerFirebase(id);
    }
  }

  document.querySelector("#chat-button").addEventListener("click", registerComment);

  const getComments = async () => {
    const id = await getUserInfo();

    // transaction_idの取得
    const pathname = location.pathname;
    const result = pathname.match(/([^\/.]+)/g);
    const transaction_id = Number(result[result.length - 1]);

    const q = query(collection(db, "comments"), where("transaction_id", "==", transaction_id), orderBy("timestamp"))

    // 監視
    onSnapshot(q, (querySnapshot) => {
      let list = "";
      document.querySelector(".chat-list").innerHTML = "";
      querySnapshot.forEach((doc) => {
        const data = doc.data();

        let className = "chat-item";
        if (data.user_id == id) {
          className += " chat-item-mine";
        }

        const timestamp = doc.data().timestamp.toDate();

        list += `<li class="${className}"><div class="chat-item-body">${data.comment}</div><span class="chat-item-time">${formatDate(timestamp)}</span></li>`;
      })
      document.querySelector(".chat-list").innerHTML = list;
    })
  }

  function formatDate(dt) {
    var y = dt.getFullYear();
    var m = ('00' + (dt.getMonth() + 1)).slice(-2);
    var d = ('00' + dt.getDate()).slice(-2);

    var h = ('00' + dt.getHours()).slice(-2);
    var i = ('00' + dt.getMinutes()).slice(-2);
    return (y + '/' + m + '/' + d + ' ' + h + ':' + i);
  }

  getComments();
</script>