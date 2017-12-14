<?php

// thoi gian xu li (PHP chay): max_excution_time=

require "simple_html_dom.php";
//  Include thư viện PHPExcel_IOFactory vào
include 'Classes/PHPExcel/IOFactory.php';

for($t = 0; $t<=1 ; $t++){
  BocTin($t);
}

function BocTin($trang){
  $html = file_get_html("https://thethao.vnexpress.net/page/$trang.html");

  $ds = $html->find(".sidebar_1 .list_news"); // find==>ARRAY

  $mang = array();

  foreach($ds as $tin){
    $tieude = $tin->find("h3.title_news a", 0)->innertext;
    $tieude = base64_encode($tieude);

    $url = $tin->find("h3.title_news a", 0)->href; // http://vnexpress.net/ada/asdasd/asdasd.png

    if(strlen($tin->find("div.thumb_art a img", 0)->getAttribute("data-original"))>0){
      $hinh = $tin->find("div.thumb_art a img", 0)->getAttribute("data-original");
    }else{
      $hinh = $tin->find("div.thumb_art a img", 0)->src;
    }

    //download
    $img = './download/'.basename($hinh);
    file_put_contents($img, file_get_contents($hinh));
    $hinh = basename($hinh);

    $tomtat = $tin->find(".description", 0)->innertext;
    $tomtat = str_replace("VnExpress", "tui", $tomtat);
    $tomtat = base64_encode($tomtat);

    $htmlCT = file_get_html($url);
    if(strlen($htmlCT->find(".content_detail", 0)->innertext)>0){
      $chitiet = $htmlCT->find(".content_detail", 0)->innertext;
    }else{
      $chitiet = "";
    }
    $chitiet = base64_encode($chitiet);

    $tin = new Tin($tieude, $url, $hinh, $tomtat, $chitiet);
    $tin->INSERTDB();

    echo base64_decode($tieude);
    echo "<hr/>";
  }
}


class Tin{
  public $TIEUDE;
  public $URL;
  public $HINH;
  public $TOMTAT;
  public $CHITIET;
  function Tin($tieude, $url, $hinh, $tomtat, $chitiet){
    $this->TIEUDE = $tieude;
    $this->URL = $url;
    $this->HINH = $hinh;
    $this->TOMTAT = $tomtat;
    $this->CHITIET = $chitiet;
  }

  function INSERTDB(){
    $qr = "INSERT INTO TINTUC VALUES()";
    // Nen kiem tra $this->URL da co trong database chua
  }

}

?>
