<?php
/**
 * Header file.
 */

use App\Core\Sample;

error_reporting(E_ALL);

require_once __DIR__ . '/Bootstrap.php';

$helper = new Sample();

if ($helper->isCli()) {
    return;
}
?>
<html>
<head>
    <title><?php echo $helper->getPageTitle(); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/app/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/app/bootstrap/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/app/bootstrap/css/phpspreadsheet.css"/>
    <script src="/app/bootstrap/js/jquery.min.js"></script>
    <script src="/app/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">自动化翻译excel</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav"><?php
                    foreach ($helper->getSamples() as $category => $files) {
                        ?>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category ?><strong
                                    class="caret"></strong></a>
                        <ul class="dropdown-menu"><?php
                            foreach ($files as $name => $file) {
                                echo '<li><a href="/app/' . $file . '">' . $name . '</a></li>';
                            } ?></ul>
                        </li>
                        <?php
                    } ?>
                </ul>
            </div>
        </div>
    </div>

