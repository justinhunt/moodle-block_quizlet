<?php 
$string['allentries'] = 'すべてのエントリー';
$string['clicktoexport'] = 'このQuizletセットを小テスト（XML）としてエクスポートする';
$string['concept'] = 'アルファベット順';
$string['emptyglossaries'] = 'このQuizletは空です（エントリーがありません）';
$string['emptyglossary'] = 'このQuizletは空です（エントリーがありません）';
$string['exportentriestoxml'] = 'エントリーを小テスト（XML）としてエクスポートする';
$string['firstmodified'] = '古いエントリーから表示する';
$string['lastmodified'] = '新しいエントリーから表示する';
$string['limitnum'] = 'エクスポートする最大エントリー数';
$string['limitnum_help'] = '選択したQuizletセットから全てのエントリーをエクスポートするには空のままにしておいてください。このオプションはサイズの大きなセット群から一部のエントリーをエクスポートするのに役立ちます。';
$string['multichoice'] = '多肢選択';
$string['notenoughentries'] = '十分なエントリー数(<b>{$a->numentries}</b>) が多肢選択の<b>用語集</b> <em>{$a->varnotenough}</em> にありません。'; 
$string['numentries'] = ' {$a} 個のエントリーをエクスポートする';
$string['noglossaries'] = 'このコースには用語集がありません';
$string['nolink'] = '用語集への自動リンクを削除する';
$string['notyetconfigured'] = 'このブロックを設定するには<b>編集モードの開始</b>をクリックしてください。';
$string['notyetconfiguredediting'] = '編集アイコンをクリックしてこのブロックを設定してください。';
$string['pluginname'] = 'QuizletQuiz';
$string['questiontype'] = '設問タイプ:';
$string['questiontype_help'] = 'Quizletのエントリーは小テストの問題バンクに多肢選択かショートアンサー形式としてエクスポートできます。
多肢選択問題は次の要素から構成されます：

* 質問テキスト：　Quizletエントリーの（用語）定義
* 正解 = Quizletエントリーの用語
* distracters = 選択した用語集（またはカテゴリー）からランダム抽出した3つのQuizlet用語

ショートアンサー（短答式）設問

* 大文字小文字の区別をしない
** 例：　"Moodle" "mooodle" いずれも正解とする
* 大文字小文字を区別する
** 例：　"Moodle"が正解の場合、"moodle"は不正解とする。';

$string['random'] = 'ランダムに';
$string['selectquizletset'] = 'エクスポートするQuizletセットを選択する';
$string['selectquizletset_help'] = 'ドロップダウンメニューを使用して、問題バンクにエクスポートするQuizletセットを選択してください。
選択をキャンセルするか、ブロックをリセットするには、ドロップダウンメニューの "選択する" を選んでください。';
$string['shortanswer'] = 'ショートアンサー';
$string['shortanswer_0'] = 'ショートアンサー（ケースセンシティブではない）';
$string['shortanswer_1'] = 'ショートアンサー（ケースセンシティブ)';
$string['sortingorder'] = '表示順';
$string['sortingorder_help'] = '問題バンクにインポートする際のエントリーの表示順序を指定できます。
この設定は最大エントリー数の設定と組合せて使用します。';
$string['quizlettoquizzes'] = 'Quizletから小テストへ';
$string['noquizletsets'] = 'Quizletのセットがありません';

$string['displayoptions'] = 'qi 表示オプション';
$string['configdisplayoptions'] = 'qi 表示オプションを設定する';
$string['printheading'] = 'qi ヘッダをプリントする';
$string['printheadingexplain'] = 'qi ヘッダプリントの説明';

$string['apikey'] = 'APIキー';
$string['apisecret'] = 'API Secret';
$string['apikeyexplain'] = 'これはQuizlet.comで作成できます。';
$string['apisecretexplain'] = 'これはQuizlet.comで作成できます。';

$string['usersets'] = 'ユーザのQuizletセット';
$string['availablesets'] = 'Quizletセット';
$string['quizletloginlabel'] = 'Quizletへのログイン';
$string['quizletlogin'] = 'QuizletセットにアクセスするにはQuizlet.comにログインし、許可してください。';
$string['quizleterror'] = 'Quizletエラー';
$string['activitytype'] = 'アクティビティタイプ';
$string['acttype_flashcards'] = 'フラッシュカード/Flashcards';
$string['acttype_scatter'] = 'スキャター/Scatter';
$string['acttype_speller'] = 'スペル練習/Speller';
$string['acttype_learn'] = '学習モード/Learn';
$string['acttype_spacerace'] = 'スペースレース/Space Race';
$string['acttype_test'] = 'テストモード/Test';
$string['acttype_moodlequiz'] = 'Moodleの小テスト';

$string['mintime'] = '最小限の学習時間';
$string['mintimedetails'] = '0にすると、システム管理者がQuizletインポートモジュール設定で指定したデフォルト値がセットされます。';
$string['width'] = '横幅';
$string['height'] = '高さ';
$string['completed'] = 'アクティビティの完了';
$string['timeleft'] = '完了までの時間:';
$string['showcountdown'] = '完了までのカウントダウンを表示する';
$string['showcompletion'] = 'Show Completion Label when Complete';
$string['createquizletimport'] = 'Quizlet活動を作成する';
$string['quizletsetinput'] = 'QuizletセットのID';
$string['exporttofileheader'] = 'Quizletセットのエクスポート';
$string['exportqqfile'] = 'Quizletセットをインポートファイルにエクスポートする';
$string['exportqqdirect'] = 'Quizletセットを問題バンクにエクスポートする';
$string['exportddfile'] = 'Quizletセットをドラッグ&ドロップファイルにエクスポートする';
$string['exportdddirect'] = 'QuizletセットをQuizletインポート活動としてエクスポートする';
$string['createmquiz'] = 'Moodleの小テストを作成する';
$string['shortanswer'] = 'ショートアンサー';
$string['shortanswer_0'] = 'ショートアンサー（ケースセンシティブではない）';
$string['shortanswer_1'] = 'ショートアンサー（ケースセンシティブ)';
$string['multichoice'] = '多肢選択';
$string['defmintime_heading'] = 'アクティビティの最小学習時間（秒）のデフォルト値';
$string['defcompletion_heading'] = '完了設定のデフォルト値（この時間を超えると完了とみなす）';
$string['searchtitles'] = 'タイトルと科目で検索する';
$string['searchterms'] = 'エントリー用語で検索する';
$string['searchusers'] = 'ユーザーで検索する';
$string['searchmysets'] = '自分のセットを取得する';
$string['exporttofileheader'] = 'Quizletセットの出力';
$string['exporttoquestionsheader'] = 'Moodle　XMLファイルとしてエクスポートする';
$string['exporttoddropheader'] = 'MoodleのDrag&Dropファイルとしてエクスポートする';
$string['exporttoquestionsdirectheader'] = 'Moodleの問題バンクにエクスポートする';
$string['exporttoddropdirectheader'] = 'Quizletインポート活動としてエクスポートする';
$string['selectforexport'] = 'エクスポートを実行するQuiletセットを選択してください';
$string['searchdetails'] = 'エクスポートを実行するQuizletセットを検索する';
$string['exporttoquestions'] = 'Quizletセットと問題タイプを選択してください。Moodleにインポート可能な設問としてエクスポートするにはボタンをクリックしてください。<br />';
$string['exporttoddrop'] = 'Quizletセットと活動タイプを選択してください。ドラッグ&ドロップタイプとしてエクスポートするにはボタンをクリックしてください。<br />';
$string['previewset'] = '選択したセットをプレビューする';
$string['noshortanswer'] = 'ショートアンサー問題なし';
$string['nomultichoice'] = '多肢選択問題なし';
$string['answernumberingnone'] = '番号なし';
$string['activitytypes'] = '活動タイプ';
$string['selectinstructions'] = '下の一覧から1つ以上の、エクスポート対象のQuizletセットを選択してください。リストが表示されない場合は、上の検索フォームを使用してください。';
$string['qchoiceinstructions'] = '1つ以上の問題タイプを選択してください。';
$string['actchoiceinstructions'] = '1つ以上の活動タイプを選択してください。';
$string['dd_exportlink'] = '活動インポートファイルとしてエクスポートする<br />';
$string['qq_exportlink'] = '小テストインポートファイルとしてエクスポートする<br />';
$string['dd_direct_exportlink'] = '現在のコースの活動としてエクスポートする<br />';
$string['qq_direct_exportlink'] = '問題バンクに問題としてエクスポートする<br />';
$string['nomatching'] = '組合せ問題なし';
$string['yesmatching'] = '組合せ問題を作成する';
$string['matching'] = '組合せ問題';
$string['noquestiontype'] = 'エクスポートする問題形式を選択していません。';
$string['noactivitytype'] = 'エクスポートする活動形式を選択していません。';
$string['noselectedset'] = 'エクスポートするQuiletセットを選択していません。';
$string['matchingquestiontext'] = '左側にあるアイテムと、対応する右側のアイテムと組み合わせる。';
$string['matchingsubcount'] = '組合せ問題の選択肢の個数';
$string['matchingsubcount_details'] = '生成される組合せ問題に含まれるマッチングペアの数';

$string['selectset'] = 'Quizletセットの選択';
$string['searchtitles'] = 'タイトルと科目で検索する';
$string['searchterms'] = '用語で検索する';
$string['searchusers'] = 'ユーザーで検索する';
$string['searchmysets'] = '自分のセットを取得する';
$string['searchtext'] = '検索キーワード';
$string['answerside'] = '解答にする面';
$string['termasanswer'] = '前面（カードの定義）(デフォルト)';
$string['definitionasanswer'] = '裏面、定義があるサイド。';
$string['answersideinstructions'] = 'フラッシュカードの表はデフォルトでは用語です。裏面が定義です。問題としてエクスポートする際には、用語が正解になります。Quizletセットが形式に合わない場合もあります。そうした場合、定義を解答にすることもできます。画像は解答になりません。そのため、デフォルトオプションが画像を含む場合に最適な設定です。';

$string['coursesection'] = 'コースセクション';
$string['sectionchoiceinstructions'] = 'Quizlet活動を追加するコースセクションの選択';

$string['exportedddtocourse'] = 'コース';
$string['exportedqqtoqbank'] = '問題バンクににエクポートされたQuizletの問題';

$string['gotoquestionbank'] = '問題バンクへ';
$string['returntopreviouspage'] = '前のページへ';

$string['quizletquiz:addinstance'] = 'Quizlet問題ブロックを追加する';
$string['quizletquiz:myaddinstance'] = 'uizlet問題ブロックを "マイホーム" に追加する';
$string['quizletquiz:view'] = 'Quizletクイズブロックを表示する';
$string['quizletquiz:export'] = 'Quizletクイズブロックをエクスポートする';