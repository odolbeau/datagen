<?php

declare(strict_types=1);

namespace Shapin\Datagen\Tests\Fixtures\TestBundle\Datagen\DBAL\Table;

use Shapin\Datagen\DBAL\Table;
use Doctrine\DBAL\Schema\Schema;

class Table3 extends Table
{
    protected static $order = 30;

    /**
     * {@inheritdoc}
     */
    public function addTableToSchema(Schema $schema)
    {
        $table = $schema->createTable('table3');

        $table->addColumn('uuid', 'string');
        $table->addColumn('field3', 'string', ['length' => 50]);
        $table->addColumn('created_at', 'bigint', ['unsigned' => true, 'notnull' => false]);

        $table->setPrimaryKey(['uuid']);
        $table->addIndex(['field3']);
    }
}
