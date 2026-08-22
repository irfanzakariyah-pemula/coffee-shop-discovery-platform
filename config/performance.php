<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Query Performance Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for query optimization and performance monitoring
    |
    */

    'pagination' => [
        'coffee_shops' => 12,
        'reviews' => 10,
        'admin_list' => 15,
    ],

    'cache' => [
        // Cache TTL in seconds
        'categories' => 3600, // 1 hour
        'facilities' => 3600, // 1 hour
        'cities' => 1800, // 30 minutes
        'popular_shops' => 900, // 15 minutes
        'stats' => 300, // 5 minutes
    ],

    'eager_load' => [
        'coffee_shops_list' => ['category', 'facilities'],
        'coffee_shop_detail' => ['category', 'facilities', 'reviews.user', 'menus', 'promotions', 'images'],
        'reviews' => ['user', 'coffeeShop'],
        'favorites' => ['coffeeShop.category'],
    ],

    'monitoring' => [
        'slow_query_threshold' => 1000, // milliseconds
        'enable_query_log' => env('QUERY_LOG_ENABLED', false),
    ],

];
