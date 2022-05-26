<?php
/**
 * 翻译excel成中文
 */

use App\Core\Sample;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XLsxReader;

require __DIR__ . '/../Header.php';

$helper = new Sample();
/*
 * 要翻译的文件路径
 */
$filename = __DIR__ . '/../temp/oldExcel/25.xlsx';

$callStartTime = microtime(true);
$reader = new XlsxReader();
$spreadsheet = $reader->load($filename);
$helper->logRead('Xlsx', $filename, $callStartTime);
//unlink($filename);
$helper->log('开始迭代excel文件：');

foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
    //$helper->log('Worksheet - ' . $worksheet->getTitle());
    $worksheetAllStr = '';
    $worksheetAllLine = [];
    foreach ($worksheet->getRowIterator() as $row) {
        //$helper->log(' Row number - ' . $row->getRowIndex());
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true); // Loop all cells, even if it is not set
        foreach ($cellIterator as $cell) {
            if ($cell !== null) {
                $cellVal = $cell->getCalculatedValue();

                if ($cellVal) {
                    $cellVal = str_replace("\n", '@o@', str_replace("\r\n", "\n", $cellVal));//转义换行符
                    $worksheetAllLine[] = $cell->getCoordinate();//保存行号
                    $worksheetAllStr .= $cellVal . PHP_EOL;//保存文本

                }
            }
        }
    }
    //每个单元格都调用api效果不好，改成每个sheet所有文字调用一次api，根据数组下标匹配翻译之后的单元格内容
    $newStrArr = $helper->autoTozh($worksheetAllStr);
    foreach ($newStrArr as $k => $value) {
        $value['dst'] = str_replace('@o@', PHP_EOL, $value['dst']);//换行符还原
        if (is_numeric($value['dst'])) {
            $value['dst'] = "'" . $value['dst'];//数字处理
        }
        $worksheet->setCellValue($worksheetAllLine[$k], $value['dst']);
    }
    sleep(1);
}
/*保存为新的文件*/
$numname = uniqid();
$newfilename = $numname . "_" . date("YmdHis", time() + 8 * 60 * 60);
$helper->write($spreadsheet, $newfilename, ['Xlsx']);