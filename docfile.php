<?php
//  Include thư viện PHPExcel_IOFactory vào
include 'Classes/PHPExcel/IOFactory.php';
 
$inputFileName = 'product.xlsx';
 
//  Tiến hành đọc file excel
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Lỗi không thể đọc file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
 
//  Lấy thông tin cơ bản của file excel
 
// Lấy sheet hiện tại
$sheet = $objPHPExcel->getSheet(0); 
 
// Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
$highestRow = $sheet->getHighestRow(); 
 
// Lấy tổng số cột của file, trong trường hợp này là 4 dòng
$highestColumn = $sheet->getHighestColumn();
 
// Khai báo mảng $rowData chứa dữ liệu
 
//  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
for ($row = 1; $row <= $highestRow; $row++){ 
    // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE,FALSE);
}
 
//In dữ liệu của mảng
echo "<pre>";
print_r($rowData);
echo "</pre>";