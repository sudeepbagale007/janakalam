<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('index'));
});

// Home > [Category]
Breadcrumbs::register('pages', function ($breadcrumbs, $pages) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($pages->title, route('page.detail', $pages->title));
});

// Home > [Category]
Breadcrumbs::register('list', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->title, route('category.list', $category->title));
});

// Home > Blog > [Category]
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->title, route('post.detail', $category->title));
});

// Home > Contact Us
Breadcrumbs::register('contact', function ($breadcrumbs, $title) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($title, route('contact', $title));
});

// Home > Share Calculator
Breadcrumbs::register('sharecalculator', function ($breadcrumbs, $title) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($title, route('sharecalculator', $title));
});

// Home > Share Calculator
Breadcrumbs::register('downloads', function ($breadcrumbs, $title) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($title, route('downloads', $title));
});







// Home > Blog
Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::register('categoryx', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
});