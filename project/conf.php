<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Base URL
define('BASE_URL', '/student_club_system/');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_student_club');

// Include autoloader
spl_autoload_register(function ($class_name) {
    // Convert class name to file path
    if (strpos($class_name, 'Controller') !== false) {
        $file = 'controllers/' . $class_name . '.php';
    } elseif (strpos($class_name, 'View') !== false) {
        $file = 'views/' . $class_name . '.php';
    } elseif ($class_name == 'Template' || $class_name == 'TemplateProcessor') {
        $file = 'views/' . $class_name . '.class.php';
    } else {
        $file = 'models/' . $class_name . '.class.php';
    }
    
    if (file_exists($file)) {
        require_once $file;
    }
});
?>