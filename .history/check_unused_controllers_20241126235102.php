<?php

// Lấy tất cả controllers
$controllers = glob(app_path('Http/Controllers/**/*.php'));

// Lấy nội dung file routes/web.php
$routesContent = file_get_contents(base_path('routes/web.php'));

$unusedControllers = [];

foreach ($controllers as $controller) {
    // Lấy tên class từ đường dẫn file
    $className = basename($controller, '.php');
    
    // Kiểm tra xem controller có được sử dụng trong routes không
    if (strpos($routesContent, $className) === false) {
        $unusedControllers[] = $controller;
    }
}

// In ra các controllers không được sử dụng
echo "Các controllers không được sử dụng:\n";
foreach ($unusedControllers as $controller) {
    echo "- " . str_replace(app_path(), 'app', $controller) . "\n";
} 