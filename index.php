<?php


require "vendor/autoload.php";

use PHPHtmlParser\Dom;
use GuzzleHttp\Client;
use Models\Database;
use Models\OzTopProject;

new Database();

$url = 'https://www.ozon.ru/';

//$user = OzTopProject::create(['title'=> 1,'userId'=> 1, 'projectId' => 1]);
$dom = new Dom;
$dom->loadFromUrl($url);
$dom = $dom->find('header')[0];

$left_menu = $dom->find('.c5y1')
    ->find('.c6b7')
    ->find('.c6b8')
    ->find('.c6b9')
    ->find('.c6c') ;

$a = $left_menu->find('div')[0];

$parents_id = [];

foreach($a as $element) {

    $pos = strpos($element, '/category/');

    if ($pos !== false) {
        $output = preg_replace( '/[^0-9]/', '', $element->href );

        $element_data = [
            'parent_id' => (int) $output,
            'parent_name' => $element->find('span')->innerHtml,
        ];

        array_push($parents_id,  $element_data);
    }
}

/*$parents_id = [
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
];*/


$client = new GuzzleHttp\Client(['base_uri' => 'https://ozon.ru/']);

$data = [];
foreach($parents_id as $key => $parent) {

  $response = $client->request('GET','/api/composer-api.bx/_action/categoryChildV2?menuId=1&categoryId=' . $parent['parent_id']);

  $data[$key] = json_decode($response->getBody(), true);
    $data[$key]['parent_name'] = $parent['parent_name'];
  
}

 //dump($data);

 foreach($data as $category) {

   dump('++++++' . $category['parent_name'] . '++++++');

    foreach($category['categories'] as $categories) {
         if(array_key_exists('categories', $categories)) {

           dump("---------------------");
           dump($categories['title']);
           dump("---------------------");

           foreach($categories['categories']  as $sub_catergory) {
             dump($sub_catergory['title']);
           }

         } else {
           dump($categories['title']);
         }
    }
}




