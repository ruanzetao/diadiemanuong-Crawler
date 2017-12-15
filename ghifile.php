<?php
require "simple_html_dom.php";

//  Include thư viện PHPExcel_IOFactory vào
include 'Classes/PHPExcel/IOFactory.php';
require "Classes/PHPExcel.php";

set_time_limit(0);

function convert_vi_to_en($str) {
  // $str = preg_replace(“/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/”, ‘a’, $str);
  // $str = preg_replace(“/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/”, ‘e’, $str);
  // $str = preg_replace(“/(ì|í|ị|ỉ|ĩ)/”, ‘i’, $str);
  // $str = preg_replace(“/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/”, ‘o’, $str);
  // $str = preg_replace(“/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/”, ‘u’, $str);
  // $str = preg_replace(“/(ỳ|ý|ỵ|ỷ|ỹ)/”, ‘y’, $str);
  // $str = preg_replace(“/(đ)/”, ‘d’, $str);
  // $str = preg_replace(“/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/”, ‘A’, $str);
  // $str = preg_replace(“/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/”, ‘E’, $str);
  // $str = preg_replace(“/(Ì|Í|Ị|Ỉ|Ĩ)/”, ‘I’, $str);
  // $str = preg_replace(“/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/”, ‘O’, $str);
  // $str = preg_replace(“/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/”, ‘U’, $str);
  // $str = preg_replace(“/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/”, ‘Y’, $str);
  // $str = preg_replace(“/(Đ)/”, ‘D’, $str);
  // //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
  // return $str;

	$unicode = array(

		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		'd'=>'đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i'=>'í|ì|ỉ|ĩ|ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'D'=>'Đ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

	);

	foreach($unicode as $nonUnicode=>$uni){
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	return $str;
}

for($t=0;$t<=10;$t++){
	GetFood($t);
}

function GetFood($trang){
	$html=file_get_html("http://diadiemanuong.com/tim-kiem?sort=%5BPlace%5D.%5BPriority%5D%20DESC%2C%20%5BPlace%5D.%5BAvgRating%5D%20DESC%2C%20%5BPlace%5D.%5BCreateDate%5D%20DESC&renderStyle=0&p=$trang");
	//echo $html;
	$array_data=array();

	$datalist=$html->find("a.list-item");
	echo count($datalist);
	echo "<br>";

	//$temp=0;
	foreach($datalist as $cuahang){
		$url=$cuahang->href;
		echo $url;
		echo "<br>";
		$tieude=utf8_decode(convert_vi_to_en($cuahang->find("h3.ddd",0)->innertext()));
		echo $tieude;
		echo "<br>";
		// convert_vi_to_en($tieude);
		// $tieude = utf8_decode($tieude);
		$danhsao=$cuahang->find("div.star",0)->getAttribute("data-star-value");
		// echo $danhsao;
		// echo "<br>";
		// $review=$cuahang->find("span.date",0)->innertext();
		// echo $review;
		// echo "<br>";
		$gia=$cuahang->find("span.price",0)->innertext();
		// echo $gia;
		// echo "<br>";
		$diachi=utf8_decode(convert_vi_to_en($cuahang->find("span.address",0)->innertext()));
		// convert_vi_to_en($diachi);
		// $diachi = utf8_decode($diachi);
		// echo $diachi;
		// echo "<br>";
		// $daxem=$cuahang->find("div.summary span",0)->innertext();
		// echo $daxem;
		// echo "<br>";
		// $binhluan=$cuahang->find("div.summary span",1)->innertext();
		// echo $binhluan;
		// echo "<br>";
		// $diadiem=$cuahang->find("div.summary span",2)->innertext();
		// echo $diadiem;
		// echo "<br>";
		$htmldetail=file_get_html("http://diadiemanuong.com".$url);
		$datadetail=$htmldetail->find("ul.totalCharts");
		foreach($datadetail as $detail){
			$dichvu=$detail->find("li ul li div.star",0)->getAttribute("data-star-value");
			// echo $dichvu;
			// echo "<br>";
			$giaca=$detail->find("li ul li div.star",1)->getAttribute("data-star-value");
			// echo $giaca;
			// echo "<br>";
			$khonggian=$detail->find("li ul li div.star",2)->getAttribute("data-star-value");
			// echo $khonggian;
			// echo "<br>";

			$luotxem=$detail->find("li ul li span",6)->innertext();
			echo $luotxem;
			echo "<br>";
			$chonhanxet=$detail->find("li ul li span",8)->innertext();
			echo $chonhanxet;
			echo "<br>";
			$tuyetchieu=$detail->find("li ul li span",10)->innertext();
			echo $tuyetchieu;
			echo "<br>";
			$baooday=$detail->find("li ul li span",12)->innertext();
			echo $baooday;
			echo "<br>";
			$baoxau=$detail->find("li ul li span",14)->innertext();
			echo $baoxau;
			echo "<br>";
			$luotthich=$detail->find("li ul li span",16)->innertext();
			echo $luotthich;
			echo "<br>";
		}

		// $array_data=array(
		// 	$temp=>array('tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich),
		// );
		// $temp++;

		// array_push($array_data,'tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich);

		// Loại file cần ghi là file excel phiên bản 2007 trở đi

		// array_push($array_data,$tieude,$danhsao,$gia,$diachi,$dichvu,$giaca,$khonggian,$luotxem,$chonhanxet,$tuyetchieu,$baooday,$baoxau,$luotthich);


		array_push($array_data,new Food($tieude,$danhsao,$gia,$diachi,$dichvu,$giaca,$khonggian,$luotxem,$chonhanxet,$tuyetchieu,$baooday,$baoxau,$luotthich));

	}

	//Khởi tạo đối tượng
	$excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
	$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
	$excel->getActiveSheet()->setTitle('Data Crawl');
//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
//Xét in đậm cho khoảng cột
	$excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
/**
 * |A1|B1|C1|..|n1|
 * |A2|B2|C2|..|n1|
 * |..|..|..|..|..|
 * |An|Bn|Cn|..|nn|
 */
$excel->getActiveSheet()->setCellValue('A1', 'TieuDe');
$excel->getActiveSheet()->setCellValue('B1', 'DanhSao');
$excel->getActiveSheet()->setCellValue('C1', 'Gia');
$excel->getActiveSheet()->setCellValue('D1', 'DiaChi');
$excel->getActiveSheet()->setCellValue('E1', 'DichVu');
$excel->getActiveSheet()->setCellValue('F1', 'GiaCa');
$excel->getActiveSheet()->setCellValue('G1', 'KhongGian');
$excel->getActiveSheet()->setCellValue('H1', 'LuotXem');
$excel->getActiveSheet()->setCellValue('I1', 'ChoNhanXet');
$excel->getActiveSheet()->setCellValue('J1', 'TuyetChieu');
$excel->getActiveSheet()->setCellValue('K1', 'BaoODay');
$excel->getActiveSheet()->setCellValue('L1', 'BaoXau');
$excel->getActiveSheet()->setCellValue('M1', 'LuotThich');

$numRow = 2;
foreach($array_data as $row){
	//$tieude,$danhsao,$gia,$diachi,$dichvu,$giaca,$khonggian,$luotxem,$chonhanxet,$tuyetchieu,$baooday,$baoxau,$luotthich
	
	// public $TenCuaHang;
	// public $DanhSao;
	// public $Gia;
	// public $DiaChi;
	// public $DichVu;
	// public $GiaCa;
	// public $KhongGian;
	// public $LuotXem;
	// public $ChoNhanXet;
	// public $TuyetChieu;
	// public $BaoODay;
	// public $BaoXau;
	// public $LuotThich;

	$excel->getActiveSheet()->setCellValue('A'.$numRow, $row->TenCuaHang);
	$excel->getActiveSheet()->setCellValue('B'.$numRow, $row->DanhSao);
	$excel->getActiveSheet()->setCellValue('C'.$numRow, $row->Gia);
	$excel->getActiveSheet()->setCellValue('D'.$numRow, $row->DiaChi);
	$excel->getActiveSheet()->setCellValue('E'.$numRow, $row->DichVu);
	$excel->getActiveSheet()->setCellValue('F'.$numRow, $row->GiaCa);
	$excel->getActiveSheet()->setCellValue('G'.$numRow, $row->KhongGian);
	$excel->getActiveSheet()->setCellValue('H'.$numRow, $row->LuotXem);
	$excel->getActiveSheet()->setCellValue('I'.$numRow, $row->ChoNhanXet);
	$excel->getActiveSheet()->setCellValue('J'.$numRow, $row->TuyetChieu);
	$excel->getActiveSheet()->setCellValue('K'.$numRow, $row->BaoODay);
	$excel->getActiveSheet()->setCellValue('L'.$numRow, $row->BaoXau);
	$excel->getActiveSheet()->setCellValue('M'.$numRow, $row->LuotThich);
	$numRow++;
}

// ở đây mình lưu file dưới dạng excel2007
PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('data.xlsx');

	// $fileType='Excel2016';

	// // Tên file cần ghi
	// $fileName = 'product_import.xlsx';

	// // Load file product_import.xlsx lên để tiến hành ghi file
	// $objPHPExcel = PHPExcel_IOFactory::load("product_import.xlsx");

	// // Thiết lập tên các cột dữ liệu
	// $objPHPExcel->setActiveSheetIndex(0)
	// 		->setCellValue('A1', "STT")
	// 		->setCellValue('A1', "TieuDe")
	//         ->setCellValue('B1', "DanhSao")
	//         ->setCellValue('C1', "Gia")
	//         ->setCellValue('D1', "DiaChi")
	//         ->setCellValue('E1', "DichVu")
	//         ->setCellValue('F1', "GiaCa")
	// 		->setCellValue('G1', "KhongGian")
	// 		->setCellValue('H1', "LuotXem")
	// 		->setCellValue('I1', "ChoNhanXet")
	// 		->setCellValue('J1', "TuyetChieu")
	// 		->setCellValue('K1', "BaoODay")
	// 		->setCellValue('L1', "BaoXau")
	// 		->setCellValue('M1', "LuotThich");


	// $i=2;
	// foreach ($array_data as $value) {
	// 	$objPHPExcel->setActiveSheetIndex(0)
	// 		->setCellValue('A$i', "$i")
	// 		->setCellValue('A$i', $value['tieude'])
	//         ->setCellValue('B$i', $value['danhsao'])
	//         ->setCellValue('C$i', $value['gia'])
	//         ->setCellValue('D$i', $value['diachi'])
	//         ->setCellValue('E$i', $value['dichvu'])
	//         ->setCellValue('F$i', $value['giaca'])
	// 		->setCellValue('G$i', $value['khonggian'])
	// 		->setCellValue('H$i', $value['luotxem'])
	// 		->setCellValue('I$i', $value['chonhanxet'])
	// 		->setCellValue('J$i', $value['tuyetchieu'])
	// 		->setCellValue('K$i', $value['baooday'])
	// 		->setCellValue('L$i', $value['baoxau'])
	// 		->setCellValue('M$i', $value['luotthich']);

	// }

	// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
	// // Tiến hành ghi file
	// $objWriter->save($fileName);
}



class Food{
	public $TenCuaHang;
	public $DanhSao;
	public $Gia;
	public $DiaChi;
	public $DichVu;
	public $GiaCa;
	public $KhongGian;
	public $LuotXem;
	public $ChoNhanXet;
	public $TuyetChieu;
	public $BaoODay;
	public $BaoXau;
	public $LuotThich;

	function Food($_TenCuaHang,$_DanhSao,$_Gia,$_DiaChi,$_DichVu,$_GiaCa,$_KhongGian,$_LuotXem,$_ChoNhanXet,$_TuyetChieu,$_BaoODay,$_BaoXau,$_LuotThich){
		$this->TenCuaHang=$_TenCuaHang;
		$this->DanhSao=$_DanhSao;
		$this->Gia=$_Gia;
		$this->DiaChi=$_DiaChi;

		$this->DichVu=$_DichVu;
		$this->GiaCa=$_GiaCa;
		$this->KhongGian=$_KhongGian;

		$this->LuotXem=$_LuotXem;
		$this->ChoNhanXet=$_ChoNhanXet;
		$this->TuyetChieu=$_TuyetChieu;
		$this->BaoODay=$_BaoODay;
		$this->BaoXau=$_BaoXau;
		$this->LuotThich=$_LuotThich;

	}

}


?>