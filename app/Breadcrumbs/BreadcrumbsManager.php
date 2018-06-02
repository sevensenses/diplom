<?php 

namespace App\Breadcrumbs;

use Illuminate\Support\HtmlString;

class BreadCrumbsManager {

	protected $callbacks = [];

	protected $generator;

	public function __construct(BreadcrumbsGenerator $generator) {
		$this->generator = $generator;
	}

	public function for(string $alias, callable $callback) {
		$this->callbacks[$alias] = $callback;
	}

	public function view(string $view, string $alias, ...$params) {
		$breadcrumbs = $this->generator->generate($this->callbacks, $alias, $params);

		$html = view($view, compact('breadcrumbs'))->render();

		return new HtmlString($html);
	}

	public function render(string $alias, ...$params) {
		$view = config('breadcrumbs.view');

		return $this->view($view, $alias, ...$params);
	}

}