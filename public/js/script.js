// font
(function(d) {
  var config = {
    kitId: 'tbp6hcd',
    scriptTimeout: 3000,
    async: true
  },
  h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
})(document);

// #を消す記述
window.onhashchange = () => {
  if (window.location.hash === '#top') {
    window.history.replaceState(null, '', window.location.pathname + window.location.search);
  }
};

// スマホでhoverを無効にする記述
var touch = 'ontouchstart' in document.documentElement
            || navigator.maxTouchPoints > 0
            || navigator.msMaxTouchPoints > 0;

if (touch) { // remove all :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
        for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;

            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;

                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                    styleSheet.deleteRule(ri);
                }
            }
        }
    } catch (ex) {}
}

// ハンバーガーメニューを開いている時はbodyにoverflow:hiddenをかける
document.getElementById('menu-btn').addEventListener('click', function(){
  document.body.classList.toggle('open')
});

// "header_menu_sp"内のaタグを取得
var menuBtn = document.querySelector(".menu-btn");
// aタグをクリックしたときの処理
document.querySelectorAll('.nav_list a').forEach(function(aTag) {
  aTag.addEventListener('click', function(event) {
      // body要素から'open'クラスを削除
      document.body.classList.remove('open');
      menuBtn.checked = false;
  });
});

// メインビジュアルのスライダー
const swiper = new Swiper('.mainvisual', {
  loop: true,
  slidesPerView: 1,
  autoplay: {
  delay: 4000,
  },
  pagination: {
  el: '.swiper-pagination',
  type: 'bullets',
  clickable: true,
  },
  speed: 2000,
  effect: 'slide',
  fadeEffect: {
  crossFade: true
  },
});

// 郵便番号から住所を検索
// zipcloudのapiへのアクセスURL
const api = "https://zipcloud.ibsnet.co.jp/api/search?zipcode=";

// お問い合わせフォームの機能
const contactForm = document.forms.contact;

// 検索ボタンがクリックされた場合、住所の取得を実行
function addressSearch() {
    // 入力された郵便番号を取得
    let input = document.getElementById("post_code");

    let value = input.value.replace("-", "");
    let url = api + value;

    // 既にエラーメッセージが表示されている場合、削除する
    let postCodeError = document.getElementsByClassName("post_code");
    let length = postCodeError.length;
    if (length > 0) {
        postCodeError[0].remove();
    }

    // zipcloud apiを使って、郵便番号の住所データを取得
    fetch(url)
        // 取得したデータをjson形式で読み込み
        .then((response) => response.json())

        // 取得したデータを出力
        .then((data) => {
            get_data =
                data.results[0].address1 +
                data.results[0].address2 +
                data.results[0].address3;

                address = document.getElementById('address');
                address.value = get_data;
        })
        .catch((error) => {
            // リストを作成
            let errorList = document.getElementsByClassName("error");
            let errorElement = document.createElement('li');
            errorElement.setAttribute('class', 'post_code');

            errorList[0].appendChild(errorElement);

            // リストにエラーメッセージを投入
            errorElement.textContent = "※郵便番号が正しくありません。";

            window.scroll({ top: 0, behavior: "smooth" });
        });
}

function validationCheck() {
    // 既にエラーメッセージが表示されている場合、削除する
    list_elements = document.getElementsByClassName("contact_errors");
    var length = list_elements.length;
    if (length > 0) {
        for (let i = 0; i < length; i++) {
            list_elements[0].remove();
        }
    }

    // バリデーションが必要な入力値を取得
    let name = document.getElementById("name").value;
    let post_code = document.getElementById("post_code").value;
    let tel = document.getElementById("tel").value;
    let fax = document.getElementById("fax").value;
    let email = document.getElementById("email").value;

    // csrf対策トークンの取得
    let token = document.querySelector('meta[name="csrf-token"]').content;

    // データを整形
    var send_data = {
        contact_name: name,
        contact_post_code: post_code,
        contact_tel: tel,
        contact_fax: fax,
        contact_email: email
    };

    const url = "/contact/confirm";
    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            if (request.status == 200) {
                contactForm.submit();
            } else if (request.status == 422) {
                var errors = JSON.parse(request.responseText);
                for (var key in errors) {
                    // リストを作成
                    let errorList = document.createElement("li");

                    if (key === "contact_post_code") {
                        errorList.className = "contact_errors post_code";
                    } else {
                        errorList.className = "contact_errors";
                    }

                    // リストにエラーメッセージを投入
                    errorList.textContent = errors[key][0];

                    // エラーメッセージのリストを表示要素に追加
                    document
                        .getElementById("contact_error_messages")
                        .appendChild(errorList);
                }
                window.scroll({ top: 0, behavior: "smooth" });
            } else {
                // リストを作成
                let errorList = document.createElement("li");
                errorList.className = "access_error";

                // リストにエラーメッセージを投入
                errorList.textContent = "不正なアクセスが検出されました。";
                // エラーメッセージのリストを表示要素に追加
                document
                    .getElementById("contact_error_messages")
                    .appendChild(errorList);
                window.scroll({ top: 0, behavior: "smooth" });
            }
        }
    };

    request.open("POST", url, true);
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.setRequestHeader("X-CSRF-TOKEN", token);
    request.setRequestHeader("Content-Type", "application/json");
    request.send(JSON.stringify(send_data));
}
