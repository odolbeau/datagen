<?php

namespace Bab\Datagen\Tests\Fixtures\TestBundle\Datagen\DBAL\Table;

use Bab\Datagen\DBAL\Table;
use Doctrine\DBAL\Schema\Schema;

class Table1 extends Table
{
    protected static $order = 10;

    /**
     * {@inheritdoc}
     */
    public function addTableToSchema(Schema $schema)
    {
        $table = $schema->createTable('table1');

        $table->addColumn('uuid', 'string');
        $table->addColumn('field1', 'string', ['length' => 50, 'nullable' => true]);
        $table->addColumn('created_at', 'bigint', ['unsigned' => true, 'nullable' => true]);

        $table->setPrimaryKey(['uuid']);
        $table->addIndex(['field1']);
    }
}