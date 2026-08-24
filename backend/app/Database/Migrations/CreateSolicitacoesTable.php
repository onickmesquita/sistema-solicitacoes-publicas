<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSolicitacoesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'protocolo'        => ['type' => 'VARCHAR', 'constraint' => 20],
            'nome_solicitante' => ['type' => 'VARCHAR', 'constraint' => 150],
            'cpf'              => ['type' => 'VARCHAR', 'constraint' => 14],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 150],
            'tipo'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'status'           => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'em_analise'],
            'criado_em'        => ['type' => 'DATETIME'],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('solicitacoes');
    }

    public function down()
    {
        $this->forge->dropTable('solicitacoes');
    }
}
