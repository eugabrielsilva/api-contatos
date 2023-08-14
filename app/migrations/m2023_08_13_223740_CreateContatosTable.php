<?php

namespace Glowie\Migrations;

use Glowie\Core\Database\Migration;
use Glowie\Core\Database\Skeleton;

class m2023_08_13_223740_CreateContatosTable extends Migration
{

    /**
     * Runs the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function run()
    {
        $this->forge->table('contatos')
            ->id()
            ->createColumn('id_pessoa', Skeleton::TYPE_BIG_INTEGER_UNSIGNED)
            ->createColumn('contato', Skeleton::TYPE_STRING, 255)
            ->createColumn('tipo', Skeleton::TYPE_STRING, 255)
            ->createTimestamps()
            ->foreignKey('id_pessoa', 'pessoas', 'id', 'CASCADE', 'CASCADE')
            ->create();
    }

    /**
     * Rolls back the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function rollback()
    {
        $this->forge->table('contatos')->drop();
    }
}
