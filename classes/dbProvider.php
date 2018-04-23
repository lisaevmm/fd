<?php

/**
 * Class DbProvider
 */
class DbProvider
{
    /** @var PDO */
    protected $connection;

    /** @var string Описание */
    private $host;

    private $db;
    private $user;
    private $pass;
    private $charset;

    /** @var static */
    protected static $instance = null;

    /**
     * @return static
     */
    public static function getInstance()
    {
        !static::$instance && (static::$instance = new static());
        return static::$instance;
    }

    /**
     * dbProvider constructor.
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $pass
     * @param string $charset
     */
    public function __construct(
        $host = '127.0.0.1',
        $db = 'news',
        $user = 'root',
        $pass = '',
        $charset = 'utf8'
    ) {

        $this->setConnectionParams($host, $db, $user, $pass, $charset);

        $this->connection = $this->connectToDB();
    }

    /**
     * @param string $host Описание
     * @param $db
     * @param $user
     * @param $pass
     * @param $charset
     */
    function setConnectionParams($host, $db, $user, $pass, $charset)
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->charset = $charset;
    }

    function connectToDB()
    {
        if (!isset($this->host) || !isset($this->db) || !isset($this->user) || !isset($this->pass) || !isset($this->charset)) {
            echo "не достаточно данных для подключения";
            exit;
        }

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdoConnection = new PDO($dsn, $this->user, $this->pass, $opt);
        return $pdoConnection;
    }

    /**
     * @param string $tableName Название таблицы
     * @return array Массив массивов - то есть таблицу
     */
    function getAll(string $tableName)
    {
        $stmt = $this->connection->prepare("SELECT * FROM {$tableName}");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     *
     * @param   string  $tableName  Таблица которую ищем
     * @param   string  $orderByColumn  Колонка для сортировки
     * @param   string  $ASCorDESC  Сортировка прямая-обратная - использовать слова *ASC* или *DESC*
     * @return  array   Массив массивов - проще говоря таблица
     */
    function getOrderBy(string $tableName, string $orderByColumn, string $ASCorDESC)
    {
        $stmt = $this->connection->prepare("SELECT * FROM {$tableName} order by {$orderByColumn} {$ASCorDESC}");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    function getRow(string $tableName, string $columnName, string $val)
    {
        $stmt = $this->connection->prepare("SELECT * FROM {$tableName} WHERE {$columnName} = :val");
        $stmt->execute(['val' => $val]);
        return $stmt->fetch(PDO::FETCH_LAZY);
    }

    function updateRow(string $tableName)
    {
        //
    }

    /**
     * @param   string  $tableName  Таблица которую ищем
     * @param   array  $columnNames Массив названий колонок
     * @param   array  $columnValues Массив значений
     */
    function addRow(string $tableName, array $columnNames, array $columnValues)
    {
        if (count($columnNames) != count($columnValues)) {
            echo "количество параметров и количество значений не совпадает";
            exit;
        }

        $columnNames = implode(", ", $columnNames);
        for ($i = 0; $i < count($columnValues); $i++) {
            $columnValues[$i] = "'" . $columnValues[$i] . "'";
        }
        $columnValues = implode(", ", $columnValues);

        echo "INSERT INTO {$tableName} ({$columnNames}) VALUES ({$columnValues})";
        $stmt = $this->connection->prepare("INSERT INTO {$tableName} ({$columnNames}) VALUES ({$columnValues})");

        $stmt->execute();
    }
}
