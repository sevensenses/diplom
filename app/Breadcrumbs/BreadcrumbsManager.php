<?php 

namespace App\Breadcrumbs;

class BreadCrumbsManager {

	protected $breadcrumbs = [];

	public function __construct(BreadcrumbsGenerator $generator) {
		$this->breadcrumbs = collect();
	}

	public function push(string $title, string $url, array $data = []) {
		$this->breadcrumbs->push((object) array_merge($data, array (
			'title' => $title,
			'url' => $url,
		)));
	}

	public function view(string $view) {
		$breadcrumbs = $this->breadcrumbs;
		
		return view($view, compact('breadcrumbs'));
	}

	public function render() {
		$view = config('breadcrumbs.view');

		return $this->view($view);
	}

}