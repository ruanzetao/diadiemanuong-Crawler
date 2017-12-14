<?php
require "simple_html_dom.php";

//  Include thư viện PHPExcel_IOFactory vào
include 'Classes/PHPExcel/IOFactory.php';

set_time_limit(0);

for($t=0;$t<=10;$t++){
	GetFood($t);
}

function GetFood($trang){
	$html=file_get_html("http://diadiemanuong.com/tim-kiem?sort=%5BPlace%5D.%5BPriority%5D%20DESC%2C%20%5BPlace%5D.%5BAvgRating%5D%20DESC%2C%20%5BPlace%5D.%5BCreateDate%5D%20DESC&renderStyle=0&p=$trang");
	//echo $html;
	//$array_data=array();

	$datalist=$html->find("a.list-item");
	echo count($datalist);
	echo "<br>";

	$temp=0;
	foreach($datalist as $cuahang){
		$url=$cuahang->href;
		echo $url;
		echo "<br>";
		$tieude=$cuahang->find("h3.ddd",0)->innertext();
		// echo $tieude;
		// echo "<br>";
		$danhsao=$cuahang->find("div.star",0)->getAttribute("data-star-value");
		// echo $danhsao;
		// echo "<br>";
		// $review=$cuahang->find("span.date",0)->innertext();
		// echo $review;
		// echo "<br>";
		$gia=$cuahang->find("span.price",0)->innertext();
		// echo $gia;
		// echo "<br>";
		$diachi=$cuahang->find("span.address",0)->innertext();
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
			$dichvu=$detail->find("li ul li div",0)->getAttribute("data-star-value");
			// echo $dichvu;
			// echo "<br>";
			$giaca=$detail->find("li ul li div",1)->getAttribute("data-star-value");
			// echo $giaca;
			// echo "<br>";
			$khonggian=$detail->find("li ul li div",2)->getAttribute("data-star-value");
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

		$array_data=array(
			$temp=>array('tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich)
		);
		$temp++;

		// array_push($array_data,'tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich);

		// Loại file cần ghi là file excel phiên bản 2007 trở đi



	}
	$fileType='Excel2016';

	// Tên file cần ghi
	$fileName = 'product_import.xlsx';

	// Load file product_import.xlsx lên để tiến hành ghi file
	$objPHPExcel = PHPExcel_IOFactory::load("product_import.xlsx");

	// Thiết lập tên các cột dữ liệu
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', "STT")
			->setCellValue('A1', "TieuDe")
	        ->setCellValue('B1', "DanhSao")
	        ->setCellValue('C1', "Gia")
	        ->setCellValue('D1', "DiaChi")
	        ->setCellValue('E1', "DichVu")
	        ->setCellValue('F1', "GiaCa")
			->setCellValue('G1', "KhongGian")
			->setCellValue('H1', "LuotXem")
			->setCellValue('I1', "ChoNhanXet")
			->setCellValue('J1', "TuyetChieu")
			->setCellValue('K1', "BaoODay")
			->setCellValue('L1', "BaoXau")
			->setCellValue('M1', "LuotThich");
			
		
	$i=2;
	foreach ($array_data as $value) {
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue("A$i", "$i")
			->setCellValue('A$i', $value['tieude'])
	        ->setCellValue('B$i', $value['danhsao'])
	        ->setCellValue('C$i', $value['gia'])
	        ->setCellValue('D$i', $value['diachi'])
	        ->setCellValue('E$i', $value['dichvu'])
	        ->setCellValue('F$i', $value['giaca'])
			->setCellValue('G$i', $value['khonggian'])
			->setCellValue('H$i', $value['luotxem'])
			->setCellValue('I$i', $value['chonhanxet'])
			->setCellValue('J$i', $value['tuyetchieu'])
			->setCellValue('K$i', $value['baooday'])
			->setCellValue('L$i', $value['baoxau'])
			->setCellValue('M$i', $value['luotthich']);

	}

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
	// Tiến hành ghi file
	$objWriter->save($fileName);
}



class Food{
	public $TenCuaHang;
	public $DanhSao;
	// public $Review;
	public $Gia;
	public $DiaChi;
	// public $DaXem;
	// public $BinhLuan;
	// public $DiaDiem;
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