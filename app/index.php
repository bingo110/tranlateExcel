<?php
// phpinfo(); exit;


use App\Core\Sample;

require_once 'Header.php';

$helper = new Sample();
$requirements = [
    'PHP 7.3.0' => version_compare(PHP_VERSION, '7.3.0', '>='),
    'PHP extension XML' => extension_loaded('xml'),
    'PHP extension xmlwriter' => extension_loaded('xmlwriter'),
    'PHP extension mbstring' => extension_loaded('mbstring'),
    'PHP extension ZipArchive' => extension_loaded('zip'),
    'PHP extension GD (optional)' => extension_loaded('gd'),
    'PHP extension dom (optional)' => extension_loaded('dom'),
];

if (!$helper->isCli()) {
    ?>
    <?php
    echo '<h3>Requirement check</h3>';
    echo '<ul>';
    foreach ($requirements as $label => $result) {
        $status = $result ? 'passed' : 'failed';
        echo "<li>{$label} ... <span class='{$status}'>{$status}</span></li>";
    }
    echo '</ul>';
} else {
    echo 'Requirement check:' . PHP_EOL;
    foreach ($requirements as $label => $result) {
        $status = $result ? '32m passed' : '31m failed';
        echo "{$label} ... \033[{$status}\033[0m" . PHP_EOL;
    }
}
$str = <<<EOF
<div>
        <p><b>使用方法:</b></p>
        <p>需本地配置php开发环境[php7.4.29]，将文件放置到下图对应的目录下，点击顶部 <b>run->autoToChinese:</b></p>

        <img src="/app/images/main.png" style="width: 100%">
    </div>
EOF;
echo $str;

$from = "auto";
$to = "zh";
$query = "対象商品のレビュー情報.表示フラグが「表示」と「非表示」の場合、レビュー情報を出力処理が逆になっている";
$helper->log('测试翻译api：');
$helper->log('翻译文本：<span style="color:#ee6424">対象商品のレビュー情報.表示フラグが「表示」と「非表示」の場合、レビュー情報を出力処理が逆になっている</span>');
$res = translate($query, $from, $to);
$helper->log('<span style="color:green"><b>请求成功</b></span>：返回数据格式如下：');
echo '<pre>';
var_export($res);
echo '</pre>';
exit;

