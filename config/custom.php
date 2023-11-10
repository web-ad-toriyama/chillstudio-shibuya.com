<?php

// カスタム設定ファイル
return [
    // ページ設定ファイル
    'page' => [
        'index' => [
            'url' => '/',
            'route' => 'index',
            'name' => 'TOP'
        ],

        'category1' => [
            'url' => '/about',
            'route' => 'about',
            'name' => 'ABOUT'
        ],

        'category2' => [
            'url' => '/service',
            'route' => 'service',
            'name' => 'SERVICE'
        ],

        // 管理画面投稿一覧を表示するページで使用してください。
        'category3' => [
            'url' => '/works',
            'route' => 'works',
            'name' => 'WORKS'
        ],

        'category3_detail' => [
            'url' => '/works/detail',
            'route' => 'works.detail',
            'name' => 'WORKS詳細'
        ],
        // -------------------------------------------------------

        'category4' => [
            'url' => '/corporate',
            'route' => 'corporate',
            'name' => 'CORPORATE'
        ],

        'category5' => [
            'url' => '/recruit',
            'route' => 'recruit',
            'name' => 'RECRUIT'
        ],

        // 管理画面お知らせ一覧を表示するページで使用してください。
        'category6' => [
            'url' => '/news',
            'route' => 'news',
            'name' => 'NEWS'
        ],
        // -------------------------------------------------------

        'category6_detail' => [
            'url' => '/news/detail',
            'route' => 'news.detail',
            'name' => 'NEWS詳細'
        ],

        'category7' => [
            'url' => '/menu',
            'route' => 'menu',
            'name' => 'MENU'
        ],

        'category8' => [
            'url' => '/faq',
            'route' => 'faq',
            'name' => 'FAQ'
        ],

        // 以下はお問合せフォームで固定の為、変更不可です
        'contact' => [
            'url' => '/contact',
            'route' => 'contact',
            'name' => 'CONTACT'
        ],

        'contact_confirm' => [
            'url' => '/contact/confirm',
            'route' => 'contact.confirm',
            'name' => 'CONTACT CONFIRM'
        ],

        'contact_send' => [
            'url' => '/contact/send',
            'route' => 'contact.send',
            'name' => 'CONTACT SEND'
        ],
        // ----------------------------------------------------------------

    ],

    /*
    ページ情報共通化の設定
    'コピー先のroute' => 'コピー元route'とすることで、ページ情報を共通化できます
    */
    'page_info' => [
        'contact.confirm' => 'contact',
        'contact.send' => 'contact',
    ],

    // お問い合わせ設定
    'contact' => [
        // 必須・任意項目
        'required' => [
            true => '必須',
            false => '任意'
        ],

        // 入力形式
        'format' => [
            '' => '選択してください',
            'text' => 'テキスト',
            'textarea' => 'テキストボックス',
            'select' => '単一選択(プルダウン)',
            'radio' => '単一選択(ラジオボタン)',
            'checkbox' => '複数選択(チェックボックス)'
        ],

        // 入力条件
        'option' => [
            '' => '選択してください',
            'kana' => 'ひらがなのみ',
            'katakana' => 'カタカナのみ',
            'numeric' => '数字のみ',
            'alpha_num' => '英数字のみ',
            'url' => 'URL形式のみ'
        ],

        /*
        編集モードの設定
        custom : 全項目
        seq_display_input : 並び替え・表示状態・必須任意のみ
        seq_display : 並び替え・表示状態のみ
        seq_only ： 並び替えのみ
        */
        'edit_mode' => [
            'custom' => 0,
            'seq_display_input' => 1,
            'seq_display' => 2,
            'seq_only' => 3,
        ],

        /*
        デフォルトのお問い合わせ項目
        「お名前」「住所」などの既存の項目については、こちらで表示名を変更できます
        */
        'default' => [
            // 例) contact_name => '氏名', 　←入力欄の表示名が「氏名」に変更されます
            'contact_name' => 'お名前',
            'contact_email' => 'メールアドレス',
            'contact_email_confirmation' => 'メールアドレス確認用',
            'contact_tel' => '電話番号',
            'contact_post_code' => '郵便番号',
            'contact_address' => '住所',
            'contact_requirement' => 'お問い合わせ用件',
            'contact_contents' => 'お問い合わせ内容',
            'contact_image' => '画像'
        ],

        // バリデーションルール
        'rules' => [
            // メールアドレス
            'email' => [
                'email:filter,dns'
            ],

            // XXXXとXXXX確認用が一致
            'confirmation' => [
                'confirmed'
            ],

            // 電話番号(数字とハイフン)
            'tel' => [
                'regex:/^[0-9０-９\-]+$/',
                'max:20'
            ],

            // 郵便番号(数字とハイフン)
            'post_code' => [
                'regex:/^[0-9０-９]{3}-?[0-9０-９]{4}$/'
            ],

            // ひらがなのみ
            'kana' => [
                'regex:/^[ぁ-んー\s]+$/u',
                'max:50'
            ],

            // カタカナのみ
            'katakana' => [
                'regex:/^[ァ-ヶヴヷヸヹヺー\s]+$/u',
                'max:50'
            ],

            // 英数字のみ (laravelデフォルトのalpha_numでは全角文字が入るので、こちらで設定しています)
            'alpha_num' => [
                'regex:/^[a-zA-Z0-9０-９-]+$/'
            ]
        ]
    ],


    // 表示アイコン設定
    'icon' => [
        'notice' => [
            '1' => 'お知らせ',
            '2' => '重要事項',
            '3' => 'ご案内',
        ],

        'news' => [
            ''=> 'アイコンを選択してください',
            1 => '重要',
            2 => '新着情報',
            3 => '更新情報',
            4 => 'イベント',
            5 => 'キャンペーン',
            6 => 'お知らせ',
        ],

        'requirement' => [
            1 => 'サービス内容',
            2 => '予約について',
            3 => '求人について',
            4 => 'その他',
        ],
    ],

    // ページネーション件数
    'paginate' => [
        'admin' => 20,  // 管理画面一覧
        'post' => '4',  // 投稿一覧
        'news' => '1',  // お知らせ一覧
    ],

    // 表示数
    'limit' => [
        'notice' => 3,  // 管理画面トップ 運営部からのお知らせ
        'post' => 4,    // トップ 最新の投稿
        'post_latest' => '4',   // 投稿詳細 最新の投稿
        'news' => 5,    // トップ お知らせ
    ],

    // 運営部からのお知らせのNEWを出す日数
    'new_life_days' => 14,

    // お問合せログに表示させる月数
    'log_life_month' => 3,

    // 表示・非表示フラグ
    'display' => [
        'off' => '0',
        'on'  => '1',
    ],

    // 画像保存先ディレクトリ名
    'directory' => [
        'post' => 'posts',
    ],

];
