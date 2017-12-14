<?php
require "simple_html_dom.php";

$html = file_get_html("https://thethao.vnexpress.net/page/1.html");

$ds = $html->find(".sidebar_1 .list_news"); // find==>ARRAY

$mang = array();

foreach($ds as $tin){
  $tieude = $tin->find("h3.title_news a", 0)->innertext;
  $tieude = base64_encode($tieude);

  $url = $tin->find("h3.title_news a", 0)->href;

  if(strlen($tin->find("div.thumb_art a img", 0)->getAttribute("data-original"))>0){
    $hinh = $tin->find("div.thumb_art a img", 0)->getAttribute("data-original");
  }else{
    $hinh = $tin->find("div.thumb_art a img", 0)->src;
  }

  $tomtat = $tin->find(".description", 0)->innertext;
  $tomtat = base64_encode($tomtat);

  $htmlCT = file_get_html($url);
  if(strlen($htmlCT->find(".content_detail", 0)->innertext)>0){
    $chitiet = $htmlCT->find(".content_detail", 0)->innertext;
  }else{
    $chitiet = "";
  }
  $chitiet = base64_encode($chitiet);

  array_push($mang, new Tin($tieude, $url, $hinh, $tomtat, $chitiet  ));
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

}

?>
