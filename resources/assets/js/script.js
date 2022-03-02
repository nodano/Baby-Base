const hamburgerTrigger = document.querySelectorAll(".hamburger-trigger");
hamburgerTrigger.forEach((element) => {
  element.addEventListener("click", () => {
    // ターゲットの取得
    const targetClass =
      element.dataset.hamburgerTarget || "hamburger-container";
    const targets = document.querySelectorAll(`.${targetClass}`);
    const addClass = element.dataset.hamburgerClass || "is-open";
    targets.forEach((target) => {
      if (element.classList.contains("is-active")) {
        element.classList.remove("is-active");
        target.classList.remove(addClass);
      } else {
        element.classList.add("is-active");
        target.classList.add(addClass);
      }
    });
    // クラス名の取得
    // 判定
    // 付け替え
  });
});

/**
 * 商品詳細のslick
 */
$("#slider").slick({
  //ここにオプション
  asNavFor: "#thumbs",
});
$("#thumbs").slick({
  //ここにオプション
  asNavFor: "#slider",
  slidesToShow: 5,
});
$("#thumbs .slick-slide").on("click", function () {
  let index = $(this).attr("data-slick-index");
  $("#slider").slick("slickGoTo", index);
});
