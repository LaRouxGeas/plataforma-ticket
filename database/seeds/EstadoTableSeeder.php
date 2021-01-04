<?php

use Illuminate\Database\Seeder;
use App\Estados;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estados::create([ 'est_nome' => 'Rascunho',  'est_descricao' => 'Rascunho de um Ticket' ]);
        Estados::create([ 'est_nome' => 'Enviado',  'est_descricao' => 'Ticket enviado, esperando um avaliador receber a solicidação' ]);
        Estados::create([ 'est_nome' => 'Em análise',  'est_descricao' => 'Ticket em análise, sua solicidação está sendo analisada por um avaliador' ]);
        Estados::create([ 'est_nome' => 'Aprovado',  'est_descricao' => 'Ticket aprovado, sua solicidação foi aprovada' ]);
        Estados::create([ 'est_nome' => 'Não aprovado',  'est_descricao' => 'Ticket não aprovado, sua solicidação não foi aprovada' ]);
        Estados::create([ 'est_nome' => 'Cancelado',  'est_descricao' => 'Ticket cancelado, este ticket foi cancelado' ]);
        Estados::create([ 'est_nome' => 'Análise em atraso',  'est_descricao' => 'Ticket em atraso, este ticket está em atraso para sua avaliação' ]);
    }
}
