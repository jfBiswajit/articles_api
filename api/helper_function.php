<?php
class Items { 
  public function __construct($time, $title, $intro, $thumbnail, $favicon, $src) {
    $this->time = $time;
    $this->title = $title;
    $this->intro = $intro;
    $this->thumbnail = $thumbnail;
    $this->favicon = $favicon;
    $this->src = $src;
  }
}

// Initial function
function getAPI($urls) {
  $data = array();
  foreach ($urls as $url) {
    $name = parse_url_all($url)['domainX'];
    $data[$name] = $name($url);
  }

  return ['type' => 'success', 'sources' => count($urls), 'data' => $data];
}

// Get domain name
function parse_url_all($url){
  $url = substr($url,0,4)=='http'? $url: 'http://'.$url;
  $d = parse_url($url);
  $tmp = explode('.',$d['host']);
  $n = count($tmp);
  if ($n>=2){
    if ($n==4 || ($n==3 && strlen($tmp[($n-2)])<=3)){
      $d['domain'] = $tmp[($n-3)].".".$tmp[($n-2)].".".$tmp[($n-1)];
      $d['domainX'] = $tmp[($n-3)];
    } else {
      $d['domain'] = $tmp[($n-2)].".".$tmp[($n-1)];
      $d['domainX'] = $tmp[($n-2)];
    }
  }
    return $d;
}