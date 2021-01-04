<?php

use Faker\Generator as Faker;

$factory->define(App\Tickets::class, function (Faker $faker) {
    return [
        'tic_titulo' => $faker->sentence(5),
        'tic_descricao' => $faker->text(),
        'tic_fk_autor' => App\Usuarios::whereHas('funcao.permissao', function($q) { $q->where('permissao.Nome', 'PTTGCC_SOLICITANTE'); })->get()->random()->id,
        'tic_fk_avaliador' => App\Usuarios::whereHas('funcao.permissao', function($q) { $q->where('permissao.Nome', 'PTTGCC_APROVADOR'); })->get()->random()->id,
        'tic_observacao_solicitante' => $faker->text(),
        'tic_observacao_aprovador' => $faker->text(),
        'tic_validade' => $faker->dateTimeBetween('now', strtotime("30-12-2019")), // usar datas antigas para validar tbm
	];
});

$factory->state(App\Tickets::class, 'rascunho', [
	'tic_fk_estado' => 1,
]);

$factory->state(App\Tickets::class, 'enviado', [
    'tic_fk_estado' => 2,
]);

$factory->state(App\Tickets::class, 'analise', [
    'tic_fk_estado' => 3,
]);

$factory->state(App\Tickets::class, 'aprovado', [
    'tic_fk_estado' => 4,
]);

$factory->state(App\Tickets::class, 'nao_aprovado', [
    'tic_fk_estado' => 5,
]);

$factory->state(App\Tickets::class, 'cancelado', [
    'tic_fk_estado' => 6,
]);

$factory->state(App\Tickets::class, 'atraso', [
    'tic_fk_estado' => 7,
]);
