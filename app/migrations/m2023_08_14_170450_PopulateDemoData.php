<?php

namespace Glowie\Migrations;

use Glowie\Core\Database\Migration;

class m2023_08_14_170450_PopulateDemoData extends Migration
{

    /**
     * Runs the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function run()
    {
        $this->db->table('pessoas')->insert([
            [
                'id' => 1,
                'nome' => 'Gabriel'
            ],
            [
                'id' => 2,
                'nome' => 'Lucas'
            ],
            [
                'id' => 3,
                'nome' => 'Adriano'
            ]
        ]);

        $this->db->table('contatos')->insert([
            [
                'id_pessoa' => 1,
                'contato' => '(62) 99835-8851',
                'tipo' => 'WhatsApp'
            ],
            [
                'id_pessoa' => 1,
                'contato' => 'gabriel.o.silva10@gmail.com',
                'tipo' => 'E-mail'
            ],
            [
                'id_pessoa' => 2,
                'contato' => '(62) 3251-4878',
                'tipo' => 'Telefone'
            ]
        ]);
    }

    /**
     * Rolls back the migration.
     * @return bool Returns true on success or false on errors.
     */
    public function rollback()
    {
        $this->forge->table('contatos')->truncate();
        $this->forge->table('pessoas')->truncate();
    }
}
