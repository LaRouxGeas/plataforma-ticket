<?php

use Illuminate\Database\Seeder;
use App\Comunicacoes;
use App\Estados;
use App\Produtos;
use App\Regioes;
use App\Empresas;
use App\PublicoAlvo;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('set foreign_key_checks = 0');

        App\Tickets::truncate();
        // $status = ['rascunho', 'enviado', 'analise', 'aprovado', 'nao_aprovado', 'cancelado', 'atraso'];
        // rand(0,6);

        factory(App\Tickets::class, 1)->states('rascunho')->create()->each(function ($ticket) {
            $ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(0, 14)));
            $ticket->empresa()->attach(Empresas::all()->random(rand(0, 2)));
            $ticket->regiao()->attach(Regioes::all()->random(rand(0, 2)));
            $ticket->produto()->attach(Produtos::all()->random(rand(0, 4)));
            $ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(rand(0, 2)));
        });

        // factory(App\Tickets::class, rand(1,10))->states('rascunho')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(0, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(0, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(rand(0, 2)));
        // 	$ticket->produto()->attach(Produtos::all()->random(rand(0, 4)));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(rand(0, 2)));
        // });

        // factory(App\Tickets::class, rand(1,10))->states('enviado')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(1, 2));
        // 	$ticket->produto()->attach(Produtos::all()->random(1));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });

        // factory(App\Tickets::class, rand(1,3))->states('analise')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(1, 2));
        // 	$ticket->produto()->attach(Produtos::all()->random(1));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });

        // factory(App\Tickets::class, rand(1,10))->states('aprovado')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(1, 2));
        // 	$ticket->produto()->attach(Produtos::all()->random(1));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });

        // factory(App\Tickets::class, rand(1,10))->states('nao_aprovado')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(1, 2));
        // 	$ticket->produto()->attach(Produtos::all()->random(1));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });

        // factory(App\Tickets::class, rand(1,3))->states('cancelado')->create()->each(function ($ticket) {
        // 	$ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        // 	$ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        // 	$ticket->regiao()->attach(Regioes::all()->random(1, 2));
        // 	$ticket->produto()->attach(Produtos::all()->random(1));
        // 	$ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });

        // factory(App\Tickets::class, rand(1,5))->states('atraso')->create()->each(function ($ticket) {
        //     $ticket->comunicacao()->attach(Comunicacoes::all()->random(rand(1, 14)));
        //     $ticket->empresa()->attach(Empresas::all()->random(rand(1, 2)));
        //     $ticket->regiao()->attach(Regioes::all()->random(1, 2));
        //     $ticket->produto()->attach(Produtos::all()->random(1));
        //     $ticket->publicoAlvo()->attach(PublicoAlvo::all()->random(1, 4));
        // });
        DB::statement('set foreign_key_checks = 1');
    }
}
