<?php

include 'config/const.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Connect
{
    /**
     * creates a connection to the database
     * @param string $path
     * @return PDO
     */
    public function connect(string $path):PDO
    {
        static $pdo;
        
        if (!$pdo) {
            if (file_exists($path)) {
                $config = include $path;
            } else {
                $msg = 'Создайте и настройте config.php';
                trigger_error($msg, E_USER_ERROR);
            }            
            $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];
            $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $pdo;
    }
}

function loadUserData(Connect $connect):array
{
        $query = "SELECT * FROM `users`";
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $conn = new Connect();
    $data = loadUserData($conn);
    http_response_code(200);
    echo json_encode($data);
}