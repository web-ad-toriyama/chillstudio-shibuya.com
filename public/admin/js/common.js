/*アコーディオン*/
$(function(){
	$('.ac_toggle').on("click", function() {
		$(this).toggleClass('opened').next().slideToggle();
	});
});

/*フルスクリーン*/
$(function(){
	$('.fullscreen_toggle').on("click", function() {
		$('.fix_search').toggleClass('opened').next().slideToggle();
	});
});
$(function(){
	$('.fullscreen_toggle').on("click", function() {
		$('.fix_menu').toggleClass('opened').next().slideToggle();
	});
});

/*ページトップ*/
$(function () {
	var startPos = 0,winScrollTop = 0;
	$(window).on("scroll", function() {
		windowWidth = $(window).width();
		windowPc = 1048;
		scrollHeight = $(document).height();
		scrollPosition = $(window).height() + $(window).scrollTop();
		footerHeight = $(".footer_wrapper").innerHeight();
		winScrollTop = $(window).scrollTop();

		//表示位置レスポンシブ対応
		if (windowWidth < windowPc) { //横幅1048px未満
		if ( scrollHeight - scrollPosition  <= footerHeight - 142 ) {
			$("#page_top").css({
			"position":"absolute",
			"bottom": footerHeight - 16
			});
		} else {
			$("#page_top").css({
			"position":"fixed",
			"bottom": "120px",
			});
		}
		} else { //横幅1048px以上
		$("#page_top").css({
			"position":"fixed",
			"bottom": "56px",
		});
		}

		//スクロールでの表示_非表示
		if (winScrollTop && winScrollTop < startPos) {
		$('#page_top').removeClass('opacity0').addClass('opacity1');
		} else {
		$('#page_top').removeClass('opacity1').addClass('opacity0');
		}
		startPos = winScrollTop;
	});
});

/*フォーム*/
$(function($){
	const Target = $('.is-empty');
	$(Target).on('change', function(){
	  if ($(Target).val() !== ""){
		$(this).removeClass('is-empty');
	  } else {
		$(this).addClass('is-empty');
	  }
	});
});

/*フォーム入力中で画面遷移しようとするとアラート*/
$(function(){
	var form_change_flg = false;
	$(window).on('beforeunload', function() {
		if (form_change_flg) {
			return "入力画面を閉じようとしています。入力中の情報がありますがよろしいですか？";
		}
	});
	//フォームの内容が変更されたらフラグを立てる
	$('form input').change(function() {
		form_change_flg = true;
	});
	$('form textarea').change(function() {
		form_change_flg = true;
	});
	// フォーム送信時はアラートOFF
	$('form').submit(function(){
		form_change_flg = false;
	});
	// 検索時はアラートOFF
	$('.bt_submit').click(function(){
		form_change_flg = false;
	});
});

// トースト表示
$(function () {
	$('.bt_toast').on('click', function () {
		$('#toast').addClass('on');
		setTimeout(function () {
			$('#toast').removeClass('on');
		}, 1000);
	});
});
$(function () {
	$('.bt_toast_reset').on('click', function () {
		$('#toast_reset').addClass('on');
		setTimeout(function () {
			$('#toast_reset').removeClass('on');
		}, 1000);
	});
});

// ナビゲーションメニューの背景色を変える
$(function(){
	var url = location.origin + location.pathname + location.search;
	  $('nav li a').each(function(){
		  var $href = $(this).prop('href');
		  if (url === $href) {
			  $(this).parents('.ac_box,li').addClass('current');
		  }
	});
});


// .max975のpadding-bottomの値を決める
// $(function(){
// 	var vh = $(window).height();
// 	var header = $('.fix_menu').height();
// 	var main = $('main').height();
// 	var footer = $('.footer_wrapper').height();
// 	var height = vh - header - main - footer;
// 	if (window.matchMedia('(min-height: 670px)').matches){
// 		$('.max975').css('padding-bottom',height);
// 	}else{
// 		$('.max975').css('padding-bottom',150);
// 	}
// });

// まとめて削除ボタン
$(function() {
	$('.check_delete').change(function() {
		var len = $('.check_delete:checked').length;
		if (len >= 1) {
		$('.delete').prop('disabled', false);
		} else {
		$('.delete').prop('disabled', true);
		}
	});
});
// 削除アラート
$(function(){
	$('.delete,.bt_delete').on('click',function(){
		var res = confirm("本当に削除しますか？");
		if( res == true ) {

		}else {
            return false;
		}
	});
});

// 選択削除ボタンモード
$(function(){
	$('.check_delete').prop('disabled',true).parent('label').css('cursor','default');
	$('.bt_choice').on('click',function(){
		var check = $('.check_delete');
		if($('#choice').prop("checked") == true){
			$(check).prop('disabled',false);
			$(check).prop('disabled',false).parent('label').css('cursor','pointer');
            $('label:not([style*="cursor: pointer;"])').parent('li').css('display', 'none');
			$('.tgl_bt,.bt_edit').addClass('disabled');
			$('.delete').css('display','flex');
			$('.add').hide();
			$(check).on('change',function() {
				var len = $('.check_delete:checked').length;
				if (len >= 1) {
					$('.delete').prop('disabled', false);
				}else{
					$('.delete').prop('disabled', true);
				}
			});
			$(check).on('change',function() {
				if($(this).prop("checked") == true){
					$(this).next('.list_box').css('background','#ffe1d9');
				}else{
					$(this).next('.list_box').css('background','#F6F6F6');
				}
			});
		}else{
		$(check).prop('disabled',true);
		$(check).prop('disabled',true).parent('label').css('cursor','default');
		$('.tgl_bt,.bt_edit').removeClass('disabled');
		$('.delete').hide();
		$('.add').show();
		$(check).removeAttr("checked").prop("checked", false).change();
        $('label:not([style*="cursor: pointer;"])').parent('li').css('display', '');
		}
	})
})

// 登録しましたバルーンを削除
$(function () {
	$('.bubbly_box').on('click', function () {
		$(this).addClass('bubbly_box_hide');
	});
});

/*SEOタグ入力フォーム*/
// まとめて編集ボタンの活性化・非活性化
function changeSelectBoxes() {
    const checkboxes = $('input[type="checkbox"]');
    const selectedValues = checkboxes.filter(':checked').map(function() {
        return this.value;
    }).get();

    if (selectedValues.length > 0) {
        $('.bt_edit.pages').prop('disabled', false);
        $('.bt_edit.pages').removeClass('disabled');
        // 各ページをチェックされた場合、「全てのページ」のチェックを解除
        $('.check_all').removeAttr("checked").prop("checked", false);
    } else {
        $('.bt_edit.pages').prop('disabled', true);
        $('.bt_edit.pages').addClass('disabled');
    }
}

function changeSelectAll() {
    const checkboxes = $('input[type="checkbox"]');
    const selectedValues = checkboxes.filter(':checked').map(function() {
        return this.value;
    }).get();

    if (selectedValues.length > 0) {
        $('.bt_edit.pages').prop('disabled', false);
        $('.bt_edit.pages').removeClass('disabled');
        if ($.inArray(selectedValues, 'all') ) {
            // 「全てのページ」をチェックされた場合、各ページのチェックを解除
            $('.check_items').removeAttr('checked').prop('checked', false);
        } else {
            // 各ページをチェックされた場合、「全てのページ」のチェックを解除
            $('.check_all').removeAttr('checked').prop('checked', false);
        }
    } else {
        $('.bt_edit.pages').prop('disabled', true);
        $('.bt_edit.pages').addClass('disabled');
    }
}

// チェックボックスをクリックした時にindexの情報を入力
$(function () {
	$('.reflect').on('click', function () {
        let id = $(this).prop('id');
        if ($(this).prop('checked')) {
            // indexページの情報を取得
            let title = $('#pageinfo_index_title').val();
            let description = $('#pageinfo_index_description').val();
            let h1 = $('#pageinfo_index_h1').val();
            let keywords = $('#pageinfo_index_keywords').val();

            // チェックされた項目にページ情報を入力
            $('#pageinfo_' + id + '_title').val(title);
            $('#pageinfo_' + id + '_description').val(description);
            $('#pageinfo_' + id + '_h1').val(h1);
            $('#pageinfo_' + id + '_keywords').val(keywords);
        } else {
            // チェックされた項目のページ情報の入力を削除
            $('#pageinfo_' + id + '_title').val('');
            $('#pageinfo_' + id + '_description').val('');
            $('#pageinfo_' + id + '_h1').val('');
            $('#pageinfo_' + id + '_keywords').val('');
        }
	});
});

/* お問い合わせ項目　カスタマイズ */
$(function(){
    //入力形式の選択時に、オプションの入力項目の表示状態を変更
    $('body').on('change', '.contact_format', function() {
        let value = $(this).val();
        let item = $(this).parents().eq(3);

        let open_option;
        let close_option;

        // テキストオプション・選択オプションの要素を取得
        let text_option = item.find('.contact_text_option');
        let select_option = item.find('.contact_select_option');

        // 選択された入力形式をもとに、オプションの表示・非表示を切り替え
        if (['text', 'textarea'].includes(value)) {
            open_option = text_option;
            close_option = select_option;
        } else {
            open_option = select_option;
            close_option = text_option;
        }

        // オプションを非表示にする際に、入力値をリセット
        close_option.find('input').each(function() {
            $(this).val('');
        });
        close_option.find('select').each(function() {
            $(this).find('option').each(function(index) {
                if (index === 0) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
        });

        open_option.removeClass('hidden');
        if(!close_option.hasClass('hidden')){
            close_option.addClass('hidden');
        }
    });

    //入力条件の変更時に文字数のオプション名を変更
    $('body').on('change', '.contact_option', function() {
        let value = $(this).val();
        let item = $(this).parents().eq(3);

        // 入力形式が数字のみの場合は「最大値」「最小値」、それ以外は「最大文字数」「最小文字数」と表示
        if (value === 'numeric') {
            item.find('label[for="max"]').text('最大値');
            item.find('label[for="min"]').text('最小値');
        } else {
            item.find('label[for="max"]').text('最大文字数');
            item.find('label[for="min"]').text('最小文字数');
        }
    });

    // 「項目を追加する」ボタンクリック時に、フォームを複製
    let add_contact_item = $('#add_contact_item');

    add_contact_item.on('click', function() {
        // 入力フォームをクローン
        let last_item = $(this).prev();
        let clone = $(last_item).clone(true);

        // クローンした内容を初期化
        clone.find('input').each(function() {
            $(this).val(this.defaultValue);
        });

        clone.find('select').each(function() {
            $(this).find('option').each(function() {
                if (this.defaultSelected) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
        });

        options = clone.find('.contact_select_option, .contact_text_option');
        options.each(function() {
            if (!$(this).hasClass('hidden')) {
                $(this).addClass('hidden');
            }
        })

        clone.find('.contact_error').text('');

        // 現在表示されている追加項目の数を取得
        let count = $('#contact_form_0').nextUntil(this).addBack().length;

        // クローンしたフォームのidや属性を書き換え
        clone.attr('id', 'contact_form_' + count);
        clone.find('.item_title').text('追加項目' + (count + 1));
        clone.find('.contact_required').attr('name', 'required[' + count + ']');
        clone.find('.contact_format').attr('name', 'format[' + count + ']');

        //1つ目の追加要素のみ削除ボタンを設置 (さらに追加を行なった場合は、このボタンが複製される)
        if (count === 1) {
            let delete_button = '<button type="button" class="contact_close_button">×</button>';
            clone.find('.item_title').after(delete_button);
        }
        last_item.after(clone);
    });

    // 項目削除ボタンクリック時に、入力フォームを削除
    $(document).on('click', '.contact_close_button', function() {
        let item = $(this).parent();
        item.remove();

        // 項目数の表記を繰下げ
        let form_items = $('#contact_form_0').nextUntil(this);

        form_items.each(function(index) {
            let count = index + 1;
            $(this).attr('id', 'contact_form_' + count);
            $(this).find('.item_title').text('追加項目' + (count + 1));
            $(this).find('.contact_required').attr('name', 'required[' + count + ']');
            $(this).find('.contact_format').attr('name', 'format[' + count + ']');
        });
    });

    // 非同期でバリデーションを実行
    $('#contact_item_form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        let formData = new FormData(form[0]);

        // エラーメッセージの初期化
        $('.contact_error').text('');

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            error: function(xhr, status, error) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    // 返却されたエラー内容を元に、エラーメッセージの表示を設置
                    for (var key in errors) {
                        console.log(errors);
                        let params = key.split('.');
                        if (params.length > 1) {
                            $('.error_' + params[0] + ':not([hidden]').eq(params[1]).text(errors[key]);
                        } else {
                            $('.error_' + params + ':not([hidden]').text(errors[key]);
                        }
                    }
                }
            },
            success: function() {
                window.location.href = '/wb-admin/contact';
            }
        })
    });
});

$(document).ready(function() {
    // お問い合わせ編集画面を開いた際に、入力形式選択時の処理を発火
    if (window.location.href.includes("contact/edit")) {
        contact_format = $('.contact_format');
        contact_format.val(contact.format).trigger('change');
    }
    if (window.location.href.includes("sort")) {
        // 一覧並び替え
        var el = document.getElementById('items');
        var sortable = Sortable.create(el);
    }
});
