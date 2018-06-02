<?php 

use App\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('dashboard', function (BreadcrumbsGenerator $trail) {
    $trail->push('Панель управления', route('admin.dashboard'));
});

/* Категории */
Breadcrumbs::for('categories', function (BreadcrumbsGenerator $trail) {
	$trail->parent('dashboard');
    $trail->push('Категории', route('admin.categories.index'));
});

Breadcrumbs::for('categories.create', function (BreadcrumbsGenerator $trail) {
	$trail->parent('categories');
    $trail->push('Создать', route('admin.categories.create'));
});

Breadcrumbs::for('categories.edit', function (BreadcrumbsGenerator $trail, $category) {
	$trail->parent('categories');
    $trail->push('Редактировать', route('admin.categories.edit', $category));
});

/* Вопросы */
Breadcrumbs::for('questions', function (BreadcrumbsGenerator $trail) {
	$trail->parent('dashboard');
    $trail->push('Вопросы', route('admin.questions.index'));
});

Breadcrumbs::for('questions.create', function (BreadcrumbsGenerator $trail) {
	$trail->parent('questions');
    $trail->push('Создать', route('admin.questions.create'));
});

Breadcrumbs::for('questions.edit', function (BreadcrumbsGenerator $trail, $question) {
	$trail->parent('questions');
    $trail->push('Редактировать', route('admin.questions.edit', $question));
});

/* Пользователи */
Breadcrumbs::for('users', function (BreadcrumbsGenerator $trail) {
	$trail->parent('dashboard');
    $trail->push('Пользователи', route('admin.users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbsGenerator $trail) {
	$trail->parent('users');
    $trail->push('Создать', route('admin.users.create'));
});

Breadcrumbs::for('users.edit', function (BreadcrumbsGenerator $trail, $user) {
	$trail->parent('users');
    $trail->push('Редактировать', route('admin.users.edit', $user));
});