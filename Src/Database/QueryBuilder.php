<?php

namespace App\Database;

use App\Contracts\DatabaseConnectionInterface;
use App\Exception\InvalidArgumentException;

class QueryBuilder
{
    protected $connection; //pdo or mysqli
    protected $table;
    protected $statement;
    protected $fields;
    protected $placeholders;
    protected $bindings; //name = ? ['joe']
    protected $operation; //SELECT, UPDATE, INSERT, DELETE

    const OPERATORS = ['=', '>=', '>', '<=', '<', '<>'];
    const PLACEHOLDER = '?';
    const COLUMNS = '*';
    const DML_TYPE_SELECT = 'SELECT';
    const DML_TYPE_UPDATE = 'UPDATE';
    const DML_TYPE_INSERT = 'INSERT';
    const DML_TYPE_DELETE = 'DELETE';

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function where($column, $operator = self::OPERATORS[0], $value = null)
    {
        if(!in_array($operator, self::OPERATORS)) {
            if($value === null) {
                $value = $operator;
                $operator = self::OPERATORS[0];
            } else {
                throw new NotFoundException('Operator is not valid', ['operator' => $operator]);
            }
        }
        $this->parseWhere([$column => $value], $operator);
        return $this;
    }    

    public function parseWhere(array $conditions, string $operator)
    {
        foreach($conditions as $column => $value) {
            $this->placeholders[] = sprintf('%s %s %s', $column, $operator, self::PLACEHOLDER);
            $this->bindings[] = $value;
        }
        return $this;
    }

    public function getPlaceHolders()
    {
        return $this->placeholders;
    }

    public function getBindings()
    {
        return $this->bindings;
    }
}