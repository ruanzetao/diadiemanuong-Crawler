<?php
require "simple_html_dom.php";

// Include thÆ° viá»‡n PHPExcel_IOFactory vÃ o
include 'Classes/PHPExcel/IOFactory.php';
require "Classes/PHPExcel.php";

set_time_limit(0);

function convert_vi_to_en($str)
{
    // $str = preg_replace(â€œ/(Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ)/â€�, â€˜aâ€™, $str);
    // $str = preg_replace(â€œ/(Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»�|áº¿|á»‡|á»ƒ|á»…)/â€�, â€˜eâ€™, $str);
    // $str = preg_replace(â€œ/(Ã¬|Ã­|á»‹|á»‰|Ä©)/â€�, â€˜iâ€™, $str);
    // $str = preg_replace(â€œ/(Ã²|Ã³|á»�|á»�|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»�|á»›|á»£|á»Ÿ|á»¡)/â€�, â€˜oâ€™, $str);
    // $str = preg_replace(â€œ/(Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯)/â€�, â€˜uâ€™, $str);
    // $str = preg_replace(â€œ/(á»³|Ã½|á»µ|á»·|á»¹)/â€�, â€˜yâ€™, $str);
    // $str = preg_replace(â€œ/(Ä‘)/â€�, â€˜dâ€™, $str);
    // $str = preg_replace(â€œ/(Ã€|Ã�|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´)/â€�, â€˜Aâ€™, $str);
    // $str = preg_replace(â€œ/(Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„)/â€�, â€˜Eâ€™, $str);
    // $str = preg_replace(â€œ/(ÃŒ|Ã�|á»Š|á»ˆ|Ä¨)/â€�, â€˜Iâ€™, $str);
    // $str = preg_replace(â€œ/(Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»�|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» )/â€�, â€˜Oâ€™, $str);
    // $str = preg_replace(â€œ/(Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®)/â€�, â€˜Uâ€™, $str);
    // $str = preg_replace(â€œ/(á»²|Ã�|á»´|á»¶|á»¸)/â€�, â€˜Yâ€™, $str);
    // $str = preg_replace(â€œ/(Ä�)/â€�, â€˜Dâ€™, $str);
    // //$str = str_replace(â€� â€œ, â€œ-â€�, str_replace(â€œ&*#39;â€�,â€�",$str));
    // return $str;
    $unicode = array(
        
        'a' => 'Ã¡|Ã |áº£|Ã£|áº¡|Äƒ|áº¯|áº·|áº±|áº³|áºµ|Ã¢|áº¥|áº§|áº©|áº«|áº­',
        'd' => 'Ä‘',
        'e' => 'Ã©|Ã¨|áº»|áº½|áº¹|Ãª|áº¿|á»�|á»ƒ|á»…|á»‡',
        'i' => 'Ã­|Ã¬|á»‰|Ä©|á»‹',
        'o' => 'Ã³|Ã²|á»�|Ãµ|á»�|Ã´|á»‘|á»“|á»•|á»—|á»™|Æ¡|á»›|á»�|á»Ÿ|á»¡|á»£',
        'u' => 'Ãº|Ã¹|á»§|Å©|á»¥|Æ°|á»©|á»«|á»­|á»¯|á»±',
        'y' => 'Ã½|á»³|á»·|á»¹|á»µ',
        'A' => 'Ã�|Ã€|áº¢|Ãƒ|áº |Ä‚|áº®|áº¶|áº°|áº²|áº´|Ã‚|áº¤|áº¦|áº¨|áºª|áº¬',
        'D' => 'Ä�',
        'E' => 'Ã‰|Ãˆ|áºº|áº¼|áº¸|ÃŠ|áº¾|á»€|á»‚|á»„|á»†',
        'I' => 'Ã�|ÃŒ|á»ˆ|Ä¨|á»Š',
        'O' => 'Ã“|Ã’|á»Ž|Ã•|á»Œ|Ã”|á»�|á»’|á»”|á»–|á»˜|Æ |á»š|á»œ|á»ž|á» |á»¢',
        'U' => 'Ãš|Ã™|á»¦|Å¨|á»¤|Æ¯|á»¨|á»ª|á»¬|á»®|á»°',
        'Y' => 'Ã�|á»²|á»¶|á»¸|á»´'
    
    );
    
    foreach ($unicode as $nonUnicode => $uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    return $str;
}

$array = GetFood(10);
exportHtml($array);


function exportHtml($array_data)
{
    // Khá»Ÿi táº¡o Ä‘á»‘i tÆ°á»£ng
    $excel = new PHPExcel();
    // Chá»�n trang cáº§n ghi (lÃ  sá»‘ tá»« 0->n)
    $excel->setActiveSheetIndex(0);
    // Táº¡o tiÃªu Ä‘á»� cho trang. (cÃ³ thá»ƒ khÃ´ng cáº§n)
    $excel->getActiveSheet()->setTitle('Data Crawl');
    // XÃ©t chiá»�u rá»™ng cho tá»«ng, náº¿u muá»‘n set height thÃ¬ dÃ¹ng setRowHeight()
    $excel->getActiveSheet()
        ->getColumnDimension('A')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('B')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('C')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('D')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('E')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('F')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('G')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('H')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('I')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('J')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('K')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('L')
        ->setWidth(15);
    $excel->getActiveSheet()
        ->getColumnDimension('M')
        ->setWidth(15);
    // XÃ©t in Ä‘áº­m cho khoáº£ng cá»™t
    $excel->getActiveSheet()
        ->getStyle('A1:M1')
        ->getFont()
        ->setBold(true);
    // Táº¡o tiÃªu Ä‘á»� cho tá»«ng cá»™t
    // Vá»‹ trÃ­ cÃ³ dáº¡ng nhÆ° sau:
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
    foreach ($array_data as $row) {
        // $tieude,$danhsao,$gia,$diachi,$dichvu,$giaca,$khonggian,$luotxem,$chonhanxet,$tuyetchieu,$baooday,$baoxau,$luotthich
        
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
        
        $excel->getActiveSheet()->setCellValue('A' . $numRow, $row->TenCuaHang);
        $excel->getActiveSheet()->setCellValue('B' . $numRow, $row->DanhSao);
        $excel->getActiveSheet()->setCellValue('C' . $numRow, $row->Gia);
        $excel->getActiveSheet()->setCellValue('D' . $numRow, $row->DiaChi);
        $excel->getActiveSheet()->setCellValue('E' . $numRow, $row->DichVu);
        $excel->getActiveSheet()->setCellValue('F' . $numRow, $row->GiaCa);
        $excel->getActiveSheet()->setCellValue('G' . $numRow, $row->KhongGian);
        $excel->getActiveSheet()->setCellValue('H' . $numRow, $row->LuotXem);
        $excel->getActiveSheet()->setCellValue('I' . $numRow, $row->ChoNhanXet);
        $excel->getActiveSheet()->setCellValue('J' . $numRow, $row->TuyetChieu);
        $excel->getActiveSheet()->setCellValue('K' . $numRow, $row->BaoODay);
        $excel->getActiveSheet()->setCellValue('L' . $numRow, $row->BaoXau);
        $excel->getActiveSheet()->setCellValue('M' . $numRow, $row->LuotThich);
        $numRow ++;
    }
    
    // á»Ÿ Ä‘Ã¢y mÃ¬nh lÆ°u file dÆ°á»›i dáº¡ng excel2007
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('data.xlsx');
    
    // $fileType='Excel2016';
    
    // // TÃªn file cáº§n ghi
    // $fileName = 'product_import.xlsx';
    
    // // Load file product_import.xlsx lÃªn Ä‘á»ƒ tiáº¿n hÃ nh ghi file
    // $objPHPExcel = PHPExcel_IOFactory::load("product_import.xlsx");
    
    // // Thiáº¿t láº­p tÃªn cÃ¡c cá»™t dá»¯ liá»‡u
    // $objPHPExcel->setActiveSheetIndex(0)
    // ->setCellValue('A1', "STT")
    // ->setCellValue('A1', "TieuDe")
    // ->setCellValue('B1', "DanhSao")
    // ->setCellValue('C1', "Gia")
    // ->setCellValue('D1', "DiaChi")
    // ->setCellValue('E1', "DichVu")
    // ->setCellValue('F1', "GiaCa")
    // ->setCellValue('G1', "KhongGian")
    // ->setCellValue('H1', "LuotXem")
    // ->setCellValue('I1', "ChoNhanXet")
    // ->setCellValue('J1', "TuyetChieu")
    // ->setCellValue('K1', "BaoODay")
    // ->setCellValue('L1', "BaoXau")
    // ->setCellValue('M1', "LuotThich");
    
    // $i=2;
    // foreach ($array_data as $value) {
    // $objPHPExcel->setActiveSheetIndex(0)
    // ->setCellValue('A$i', "$i")
    // ->setCellValue('A$i', $value['tieude'])
    // ->setCellValue('B$i', $value['danhsao'])
    // ->setCellValue('C$i', $value['gia'])
    // ->setCellValue('D$i', $value['diachi'])
    // ->setCellValue('E$i', $value['dichvu'])
    // ->setCellValue('F$i', $value['giaca'])
    // ->setCellValue('G$i', $value['khonggian'])
    // ->setCellValue('H$i', $value['luotxem'])
    // ->setCellValue('I$i', $value['chonhanxet'])
    // ->setCellValue('J$i', $value['tuyetchieu'])
    // ->setCellValue('K$i', $value['baooday'])
    // ->setCellValue('L$i', $value['baoxau'])
    // ->setCellValue('M$i', $value['luotthich']);
    
    // }
    
    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
    // // Tiáº¿n hÃ nh ghi file
    // $objWriter->save($fileName);
}

function GetFood($trang)
{
    $array_data = array();
    
    // loop from 1 to 10 pages
    // 1. get html from current page.
    // 2. pushing data in loop
    for ($i = 1; i <= 10; $i++) {
        $html = file_get_html("http://diadiemanuong.com/tim-kiem?sort=%5BPlace%5D.%5BPriority%5D%20DESC%2C%20%5BPlace%5D.%5BAvgRating%5D%20DESC%2C%20%5BPlace%5D.%5BCreateDate%5D%20DESC&renderStyle=0&p=$i");
        // echo $html;
                
        $datalist = $html->find("a.list-item");
        echo count($datalist);
        echo "<br>";
        
        // $temp=0;
        foreach ($datalist as $cuahang) {
            $url = $cuahang->href;
            echo $url;
            echo "<br>";
            $tieude = utf8_decode(convert_vi_to_en($cuahang->find("h3.ddd", 0)->innertext()));
            echo $tieude;
            echo "<br>";
            // convert_vi_to_en($tieude);
            // $tieude = utf8_decode($tieude);
            $danhsao = $cuahang->find("div.star", 0)->getAttribute("data-star-value");
            // echo $danhsao;
            // echo "<br>";
            // $review=$cuahang->find("span.date",0)->innertext();
            // echo $review;
            // echo "<br>";
            $gia = $cuahang->find("span.price", 0)->innertext();
            // echo $gia;
            // echo "<br>";
            $diachi = utf8_decode(convert_vi_to_en($cuahang->find("span.address", 0)->innertext()));
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
            $htmldetail = file_get_html("http://diadiemanuong.com" . $url);
            $datadetail = $htmldetail->find("ul.totalCharts");
            foreach ($datadetail as $detail) {
                $dichvu = $detail->find("li ul li div.star", 0)->getAttribute("data-star-value");
                // echo $dichvu;
                // echo "<br>";
                $giaca = $detail->find("li ul li div.star", 1)->getAttribute("data-star-value");
                // echo $giaca;
                // echo "<br>";
                $khonggian = $detail->find("li ul li div.star", 2)->getAttribute("data-star-value");
                // echo $khonggian;
                // echo "<br>";
                
                $luotxem = $detail->find("li ul li span", 6)->innertext();
                echo $luotxem;
                echo "<br>";
                $chonhanxet = $detail->find("li ul li span", 8)->innertext();
                echo $chonhanxet;
                echo "<br>";
                $tuyetchieu = $detail->find("li ul li span", 10)->innertext();
                echo $tuyetchieu;
                echo "<br>";
                $baooday = $detail->find("li ul li span", 12)->innertext();
                echo $baooday;
                echo "<br>";
                $baoxau = $detail->find("li ul li span", 14)->innertext();
                echo $baoxau;
                echo "<br>";
                $luotthich = $detail->find("li ul li span", 16)->innertext();
                echo $luotthich;
                echo "<br>";
            }
            
            // $array_data=array(
            // $temp=>array('tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich),
            // );
            // $temp++;
            
            // array_push($array_data,'tieude'=>$tieude,'danhsao'=>$danhsao,'gia'=>$gia,'diachi'=>$diachi,'dichvu'=>$dichvu,'giaca'=>$giaca,'khonggian'=>$khonggian,'luotxem'=>$luotxem,'chonhanxet'=>$chonhanxet,'tuyetchieu'=>$tuyetchieu,'baooday'=>$baooday,'baoxau'=>$baoxau,'luotthich'=>$luotthich);
            
            // Loáº¡i file cáº§n ghi lÃ  file excel phiÃªn báº£n 2007 trá»Ÿ Ä‘i
            
            // array_push($array_data,$tieude,$danhsao,$gia,$diachi,$dichvu,$giaca,$khonggian,$luotxem,$chonhanxet,$tuyetchieu,$baooday,$baoxau,$luotthich);
            
            array_push($array_data, new Food($tieude, $danhsao, $gia, $diachi, $dichvu, $giaca, $khonggian, $luotxem, $chonhanxet, $tuyetchieu, $baooday, $baoxau, $luotthich));
        }
    }
    return $array_data;
}

class Food
{

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

    function Food($_TenCuaHang, $_DanhSao, $_Gia, $_DiaChi, $_DichVu, $_GiaCa, $_KhongGian, $_LuotXem, $_ChoNhanXet, $_TuyetChieu, $_BaoODay, $_BaoXau, $_LuotThich)
    {
        $this->TenCuaHang = $_TenCuaHang;
        $this->DanhSao = $_DanhSao;
        $this->Gia = $_Gia;
        $this->DiaChi = $_DiaChi;
        
        $this->DichVu = $_DichVu;
        $this->GiaCa = $_GiaCa;
        $this->KhongGian = $_KhongGian;
        
        $this->LuotXem = $_LuotXem;
        $this->ChoNhanXet = $_ChoNhanXet;
        $this->TuyetChieu = $_TuyetChieu;
        $this->BaoODay = $_BaoODay;
        $this->BaoXau = $_BaoXau;
        $this->LuotThich = $_LuotThich;
    }
}

?>