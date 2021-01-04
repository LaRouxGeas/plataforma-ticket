<?php

use Illuminate\Database\Seeder;
use App\Comunicacoes;
use App\Estados;
use App\Produtos;
use App\Regioes;
use App\Empresas;
use App\PublicoAlvo;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoTableSeeder::class);

        Comunicacoes::create([ 'com_nome' => 'Segunda via de Boleto', 'com_descricao' => 'Boleto' ]);
        Comunicacoes::create([ 'com_nome' => 'Liberação da BIN', 'com_descricao' => 'BIN' ]);
        Comunicacoes::create([ 'com_nome' => 'Ouvidoria', 'com_descricao' => 'Ouvidoria' ]);
        Comunicacoes::create([ 'com_nome' => 'Diversos Ouvidoria', 'com_descricao' => 'Ouvidoria' ]);
        Comunicacoes::create([ 'com_nome' => 'Diversos SAC', 'com_descricao' => 'SAC' ]);

        Produtos::create([ 'pro_nome' => 'Financiamento', 'pro_descricao' => 'Sem descrição' ]);
        Produtos::create([ 'pro_nome' => 'Farplan', 'pro_descricao' => 'Sem descrição' ]);
        Produtos::create([ 'pro_nome' => 'Carteiro DAf', 'pro_descricao' => 'Sem descrição' ]);
        Produtos::create([ 'pro_nome' => 'Outros', 'pro_descricao' => 'Sem descrição' ]);

        Regioes::create([ 'reg_nome' => 'Curitiba', 'reg_descricao' => 'Paraná' ]);
        Regioes::create([ 'reg_nome' => 'Ponta Grossa', 'reg_descricao' => 'Paraná' ]);
        Regioes::create([ 'reg_nome' => 'Brasil', 'reg_descricao' => 'America do sul' ]);

        Empresas::create([ 'emp_nome' => 'SAC - Ouvidoria', 'emp_descricao' => 'SAC' ]);

        PublicoAlvo::create([ 'pua_nome' => 'PJ', 'pua_descricao' => 'Pessoa Jurídica' ]);

        // $this->call(TicketTableSeeder::class);


        // $this->call(UsersTableSeeder::class);
        // factory(App\User::class, 18)->create();
    }
}
