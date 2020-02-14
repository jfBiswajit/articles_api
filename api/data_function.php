<?php
require_once 'dom_parser.php';

// Theverge
function theverge($url) {
  $theverge = new simple_html_dom();
  $data = array();
  $theverge->load_file($url);
  $listsAr = $theverge->find('.c-entry-box--compact.c-entry-box--compact--article');
  $favicon = $theverge->find('link[rel]', 11)->href;
  $counter = 0;

  foreach ($listsAr as $listsOj) {
    $postDOM = new simple_html_dom();
    $title = $listsOj->find('h2 a', 0)->innertext;
    $src = $listsOj->find('h2 a', 0)->href;
    $thumbnail = $listsOj->find('img', 0)->src;
    $postDOM->load_file($src);
    $introFull = $postDOM->find('.c-entry-content p', 1)->innertext;
    $intro = substr($introFull, 0, 280) . '...';
    $time = $postDOM->find('time', 0)->innertext;

    $data[$counter] = new Items($time, $title, $intro, $thumbnail, $favicon, $src);
    
    $counter++;
    if ($counter > 10) {
      break;
    }
  }

  return $data;
}