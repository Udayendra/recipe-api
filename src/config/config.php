<?php
// Load environment variables
namespace Hp\MyApp\Config;

use Dotenv\Dotenv;
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

function isDocker(): bool {
    return file_exists('/.dockerenv') || getenv('DOCKER') === 'true';
}
// Return config array
return [
    'db' => [
        'host' => $_ENV['MYSQL_HOST'] ?? (isDocker() ? 'db' : '127.0.0.1'),
        'port' => 3306,
        'database' => $_ENV['MYSQL_DATABASE'],
        'user' => $_ENV['MYSQL_USER'],
        'password' => $_ENV['MYSQL_PASSWORD'],
    ],
    'jwt' => [
        'secret' => $_ENV['JWT_SECRET'],
    ]
    // 'app' => [
    //     'env' => $_ENV['APP_ENV'] ?? 'production',
    //     'debug' => $_ENV['APP_DEBUG'] ?? false,
    // ]
];
