<?php

// Определение параметров загрузки файла изображения
define('ALLOW_FILE_TYPES', ['image/jpg', 'image/jpeg', 'image/png']);
define('ALLOWED_FILE_SIZE', 2);

// Задание парраметров ролей пользователей: 0-обычный, 1-администратор, 2-контент-менеджер
define('ROLE_USER', 0);
define('ROLE_ADMINISTRATOR', 1);
define('ROLE_CONTENT_MANAGER', 2);

return [
    'image' => [
        'allowFileTypes' => ALLOW_FILE_TYPES,
        'allowedFileSize' => ALLOWED_FILE_SIZE
    ],
    'role' => [
        'roleUser' => ROLE_USER,
        'roleAdministrator' => ROLE_ADMINISTRATOR,
        'roleContentManager' => ROLE_CONTENT_MANAGER,
    ]
];
