<?php

return [
    '/products' => [
        'controller' => 'Product',
        'action' => 'getProducts',
    ],
    "/product/(\d+)" => [
        'controller' => 'Product',
        'action' => 'getProduct',
    ],
    "/product/create" => [
        'controller' => 'Product',
        'action' => 'createProduct',
    ],
    "/product/(\d+)/edit" => [
        'controller' => 'Product',
        'action' => 'editProduct',
    ],
    "/product/(\d+)/delete" => [
        'controller' => 'Product',
        'action' => 'deleteProduct',
    ],
    "/product/(\d+)/price" => [
        'controller' => 'Product',
        'action' => 'editPrice',
    ],
    "/product/(\d+)/amount" => [
        'controller' => 'Product',
        'action' => 'editAmount',
    ],
    '/user/products' => [
        'controller' => 'Product',
        'action' => 'getCurrentUsersProducts',
    ],
];