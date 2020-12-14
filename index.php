<?php


require "vendor/autoload.php";

use PHPHtmlParser\Dom;
use GuzzleHttp\Client;

$url = 'https://www.ozon.ru/';


$dom = new Dom;
$dom->loadFromUrl($url);
$dom = $dom->find('header')[0];

$left_menu = $dom->find('.c5y1')
    ->find('.c6b7')
    ->find('.c6b8')
    ->find('.c6b9')
    ->find('.c6c') ;

$a = $left_menu->find('div')[0];

$parents = [];

foreach($a as $element) {
  array_push($parents, $element->href);

}

dump($parents);

$parents_id = [
  15500,
  7500,
  14500,
  7000,
  6500,
  10500,
  11000,
  9700,
  9200,
  6000,
  12300,
  16500,
  33332,
  8500,
  15000,
  13500,
  50001,
  13100,
  18000,
  9000,
  8000,
  32056,
  14572,
  25000,
  13300,
  34452
];


$client = new GuzzleHttp\Client(['base_uri' => 'https://ozon.ru/']);

foreach($parents_id as $key => $parent) { 

  $response = $client->request('GET',"/api/composer-api.bx/_action/categoryChildV2?menuId=1&categoryId=$parent");

  $data[$key] = json_decode($response->getBody(), true);
  
}

dump($data);
     



