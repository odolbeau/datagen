<?php

declare(strict_types=1);

namespace Shapin\Datagen\Tests\Fixtures\TestBundle\Datagen;

use Doctrine\DBAL\Schema\Schema;
use Shapin\Datagen\DBAL\Table;

class Table3 extends Table
{
    protected static $tableName = 'table3';
    protected static $order = 30;

    /**
     * {@inheritdoc}
     */
    public function addTableToSchema(Schema $schema)
    {
        $table = $schema->createTable(self::$tableName);

        $table->addColumn('uuid', 'string');
        $table->addColumn('field3', 'string', ['length' => 50]);
        $table->addColumn('created_at', 'bigint', ['unsigned' => true, 'notnull' => false]);

        $table->setPrimaryKey(['uuid']);
        $table->addIndex(['field3']);
    }

    /**
     * {@inheritdoc}
     */
    public function getRows(): iterable
    {
        return [
            ['uuid' => 'uuid3_1', 'field3' => 'another_field'],
            ['uuid' => 'uuid3_2', 'field3' => 'another_field'],
            ['uuid' => 'uuid3_3', 'field3' => 'another_field'],
        ];
    }
}
