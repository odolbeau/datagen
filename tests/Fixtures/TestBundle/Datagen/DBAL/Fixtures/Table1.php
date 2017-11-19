<?php

namespace Bab\Datagen\Tests\Fixtures\TestBundle\Datagen\DBAL\Fixtures;

use Bab\Datagen\DBAL\Fixture;

class Table1 extends Fixture
{
    protected static $tableName = 'table1';
    protected static $order = 10;

    public function getRows(): array
    {
        return [
            ['uuid' => 'uuid1_1'],
            ['uuid' => 'uuid1_2'],
            ['uuid' => 'uuid1_3'],
        ];
    }
}
