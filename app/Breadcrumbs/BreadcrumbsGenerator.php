<?php 

namespace App\Breadcrumbs;

class BreadcrumbsGenerator {

	protected $breadcrumbs;

	protected $callbacks;

	public function generate(array $callbacks, string $alias, array $params) {
		$this->breadcrumbs = collect();
		$this->callbacks = $callbacks;

		$this->call($alias, $params);

		return $this->breadcrumbs;
	}

	public function call(string $alias, array $params) {
		$this->callbacks[$alias]($this, ...$params);
	}
	
	public function parent(string $alias, ...$params) {
		$this->call($alias, $params);
	}

	public function push(string $title, string $url, array $data = []) {
		$this->breadcrumbs->push((object) array_merge($data, array (
			'title' => $title,
			'url' => $url,
		)));
	}

}