<?php

class dbProvider
{
    /*
     * @var object  pdoConnection
     */
    private $connection;

    public function __construct(
        $host = '127.0.0.1',
        $db = 'news',
        $user = 'root',
        $pass = '',
        $charset = 'utf8'
    ) {
        $this->connection = connectToDB($host, $db, $user, $pass, $charset);
    }

    /*
     * @param   string  $host       Адрес БД (например 127.0.0.1)
     * @param   string  $db         Название БД
     * @param   string  $user       Имя пользователя
     * @param   string  $pass       Пароль пользователя
     * @param   string  $charset    (например *utf-8*)
     * @return  object  $pdoConnection
     */
    function connectToDB($host, $db, $user, $pass, $charset)
    {

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdoConnection = new PDO($dsn, $user, $pass, $opt);
        return $pdoConnection;
    }

    function getAllFromTable(string $tableName, string $orderByColumn, string $ASCorDESC)
    {
        $stmt = $this->connection->prepare('SELECT * FROM :tableName order by :orderByColumn :ASCorDESC');
        $stmt->execute(['tablename' => $tableName, 'orderByColumn' => $orderByColumn, 'ASCorDESC' => $ASCorDESC]);
        return $stmt->fetchAll();
    }

}