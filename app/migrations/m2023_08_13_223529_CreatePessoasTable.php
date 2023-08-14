<?php

namespace Glowie\Migrations;

use Glowie\Core\Database\Migration;
use Glowie\Core\Database\Skeleton;

class m2023_08_13_223529_CreatePessoasTable extends Migration
{

    /**
     * Runs the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function run()
    {
        $this->forge->table('pessoas')
            ->id()
            ->createColumn('nome', Skeleton::TYPE_STRING, 255)
            ->createTimestamps()
            ->create();
    }

    /**
     * Rolls back the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function rollback()
    {
        $this->forge->table('pessoas')->drop();
    }
}
