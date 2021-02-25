<?php


use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// home/
Breadcrumbs::for('dashboard', function (BreadcrumbsGenerator $trail) {
    $trail->push('خانه', '/');
});
// home/users
Breadcrumbs::for('admin.users.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('کاربران', route('admin.users.index'));
});
// home/users/create
Breadcrumbs::for('admin.users.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.users.index');
    $trail->push('ایجاد کاربر', route('admin.users.create'));
});
Breadcrumbs::for('admin.users.edit', function (BreadcrumbsGenerator $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('ویرایش کاربر');
    $trail->push($user->email);
});
Breadcrumbs::for('admin.users.permission', function (BreadcrumbsGenerator $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('اعمال دسترسی');
    $trail->push($user->email);
});
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('سطوح دسترسی', route('admin.permissions.index'));
});

Breadcrumbs::for('admin.permissions.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.permissions.index');
    $trail->push(' ایجاد دسترسی', route('admin.permissions.create'));
});
Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbsGenerator $trail, $permission) {
    $trail->parent('admin.permissions.index');
    $trail->push('ویرایش دسترسی');
    $trail->push($permission->name);
});


Breadcrumbs::for('admin.roles.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('مقام ها', route('admin.roles.index'));
});
Breadcrumbs::for('admin.roles.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.roles.index');
    $trail->push(' ایجاد مقام', route('admin.permissions.create'));
});
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbsGenerator $trail, $role) {
    $trail->parent('admin.roles.index');
    $trail->push('ویرایش مقام');
    $trail->push($role->name);
});
Breadcrumbs::for('admin.products.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('محصولات', route('admin.products.index'));
});
Breadcrumbs::for('admin.products.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.products.index');
    $trail->push(' ایجاد محصول', route('admin.products.create'));
});
Breadcrumbs::for('admin.products.edit', function (BreadcrumbsGenerator $trail, $product) {
    $trail->parent('admin.products.index');
    $trail->push('ویرایش محصول');
    $trail->push($product->title);
});
Breadcrumbs::for('admin.comments.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('نظرات', route('admin.comments.index'));
});
Breadcrumbs::for('admin.comments.user', function (BreadcrumbsGenerator $trail, $user) {
    $trail->parent('admin.comments.index');
    $trail->push('کاربر');
    $trail->push($user->email);
});
Breadcrumbs::for('admin.comments.replay', function (BreadcrumbsGenerator $trail, $comment) {
    $trail->parent('admin.comments.user' , $comment->user);
    $trail->push("پاسخ به نظر با آیدی . {$comment->id}");

});

Breadcrumbs::for('admin.comments.edit', function (BreadcrumbsGenerator $trail, $comment) {
    $trail->parent('admin.comments.user' , $comment->user);
    $trail->push('ویرایش');
});
Breadcrumbs::for('admin.categories.index', function (BreadcrumbsGenerator $trail) {
    $trail->parent('dashboard');
    $trail->push('دسته بندی ها', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.edit', function (BreadcrumbsGenerator $trail , $category) {
    $trail->parent('admin.categories.index');
    $trail->push('ویرایش');
    $trail->push($category->name);
});

Breadcrumbs::for('admin.categories.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('admin.categories.index');
    $trail->push('ایجاد دسته بندی', route('admin.categories.create'));
});
