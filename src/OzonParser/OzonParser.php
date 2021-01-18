<?php

namespace OzonParser;

use OzonParser\Models\Database;
use OzonParser\Models\OzTopProject;
use PHPHtmlParser\Dom;
use GuzzleHttp;

class OzonParser {

	public $url = 'https://www.ozon.ru/';
	public $category = [];

	public function __construct() {
       	new Database();
	}

	public function run() {
		$this->parser();
		$this->insert();
	}

	public function parser() {

		$dom = new Dom;
		$dom->loadFromUrl($this->url);
		$dom = $dom->find('header')[0];

		$left_menu = $dom->find('.c5y1')
			->find('.c6b7')
			->find('.c6b8')
			->find('.c6b9')
			->find('.c6c') ;

		$a = $left_menu->find('div')[0];

		foreach($a as $element) {

			$pos = strpos($element, '/category/');

			if ($pos !== false) {
				$output = preg_replace( '/[^0-9]/', '', $element->href );

				$element_data = [
				    'parent_id' => (int) $output,
				    'parent_name' => $element->find('span')->innerHtml,
				    'url' => $element->href
				];

				array_push($this->category,  $element_data);
			}
		}
	}
	
	private function insert() {
		
		$client = new GuzzleHttp\Client(['base_uri' => $this->url]);
		$data = [];

		foreach($this->category as $key => $parent) {
			
			$response = $client->request('GET','/api/composer-api.bx/_action/categoryChildV2?menuId=1&categoryId=' . $parent['parent_id']);
			
			$data[$key] = json_decode($response->getBody(), true);
			$data[$key]['parent_name'] = $parent['parent_name'];
			$data[$key]['url'] = $parent['url'];
			
		}

		foreach($data as $category) {
			
			$parent_category =  OzTopProject::create(['title'=> $category['parent_name'], 'userId'=> 1, 'projectId' => 1, 'currentUrl' => $category['url']]);

			foreach($category['categories'] as $categories) {
				  
				if(array_key_exists('categories', $categories)) {

					$sub_category =  OzTopProject::create([
						'title'=> $categories['title'],
						'userId'=> 1,
						'projectId' => 1,
						'parent_id' => $parent_category->id,
						'currentUrl' => $categories['url']
					]);

					foreach($categories['categories']  as $sub_cat) {

						OzTopProject::create(
							['title'=> $sub_cat['title'],
							'userId'=> 1,
							'projectId' => 1,
							'parent_id' => $sub_category->id,
							'currentUrl' => $sub_cat['url']
						]);
					}
		
				} else {
					
					OzTopProject::create([
						'title'=> $categories['title'],
						'userId'=> 1,
						'projectId' => 1,
						'currentUrl' => $categories['url']
					]);
					
				}
			}
		}
	}
}
