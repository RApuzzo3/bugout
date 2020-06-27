<?php

namespace tests\Units;

use App\Database\PDOConnection;
use App\Database\QueryBuilder;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{   
    private $queryBuilder;

    public function setUp()
    {
        $pdo = new PDOConnection(Config::get('database', 'pdo'),
            ['db_name' => 'bugout_testing']);
        $this->queryBuilder = new QueryBuilder(
            $pdo->connect()
        );
        parent::setUp();
    }

    public function testBindings()
    {
        $query = $this->queryBuilder->where('id', 7)->where('report_type', '>=', '100');
        self::assertIsArray($query->getPlaceholders());
        self::assertIsArray($query->getBindings());
        
        var_dump($query->getBindings(),$query->getPlaceholders());
        exit;
    }

    public function testItCanCreateRecords()
    {
        $id = $this->queryBuilder->table('reports')->create($data);
        self::assertNotNull($id);
    }

    public function testItCanPerformRawQuery()
    {
        $result = $this->queryBuilder->raw("SELECT * FROM reports;");
        self::assertNotNull($result);
    }

    public function testItCanPerformSelectQuery()
    {
        $result = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1)
            ->first();
            self::assertNotNull($result);
            self::assertSame(1, (int)$result->id);
    }

    public function testItCanPerformSelectQueryWithMultipleWhereClause()
    {
        $result = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1)
            ->where('report_type', '=', 'Report Type 1')
            ->first();
            self::assertNotNull($result);
            self::assertSame(1, (int)$result->id);
            self::assertSame(1, (string)$result->report_type);
    }    
}