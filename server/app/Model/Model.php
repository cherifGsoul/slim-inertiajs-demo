<?php declare(strict_types=1);
namespace App\Model;

use Cake\Database\Connection;
use Cake\Database\Driver\Sqlite;
use Cake\Utility\Inflector;

class Model
{
    /**
     * DB
     *
     * @var Connection
     */
    protected Connection $db;

    /**
     * Table
     *
     * @var string
     */
    protected string $table = '';

    /**
     * Instance
     *
     * @var self
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $root = dirname(dirname(dirname(__DIR__)));
        $this->db = new Connection([
            'driver' => Sqlite::class,
	        'database' => "$root/db/noesis.db"
        ]);
    }

    /**
     * Get Instancec
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * Undocumented function
     *
     * @param array $where
     * @param callable|array|string $fields
     * 
     * @return array
     */
    public static function where(array $where, callable|array|string $fields = '*'): array
    {

        $model = self::getInstance();
        $query = $model->db->newQuery();

        $statement = $query->select($fields)->from($model->table)->where($where)->execute();

        return $statement->fetchAll();
    }
}