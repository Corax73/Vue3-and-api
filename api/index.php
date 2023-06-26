<?php

include 'config/const.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: *");

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
        $query = "SELECT * FROM `tasks`";
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
}

function saveUser(Connect $connect, string $title, string $descriptions, int $importance, int $implementation):bool
    {
        $query = 'INSERT INTO `tasks` (title, descriptions, importance, implementation) VALUES (:title, :descriptions, :importance, :implementation)';
        $params = [
            ':title' => $title,
            ':descriptions' => $descriptions,
            ':importance' => $importance,
            ':implementation' => $implementation
        ];
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

if ($_SERVER['REQUEST_METHOD'] == 'GET' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/all') {
    $conn = new Connect();
    $data = loadUserData($conn);
    http_response_code(200);
    print json_encode($data);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['CONTENT_TYPE'] == 'application/json' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/create') {
    $str = file_get_contents('php://input').PHP_EOL;
    $strArr = json_decode($str, true);
    $conn = new Connect();
    if ($newUser = saveUser($conn, $strArr['title'], $strArr['descriptions'], $strArr['importance'], $strArr['implementation'])) {
        print 'Task created!';
    } else {
        print 'error';
    }
} else {
    print 'error';
}
