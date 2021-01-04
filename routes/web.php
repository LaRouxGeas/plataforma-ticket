<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
// 	return view('inc.index');
// });
Route::get('/', 'TicketController@inicio');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/usuario/solicitantes', 'UsuarioController@solicitantes');
	Route::get('/usuario/aprovadores', 'UsuarioController@aprovadores');
	Route::get('/sair', 'UsuarioController@sair');
	Route::get('/temporario', 'UsuarioController@temp');
	Route::get('/estado', 'EstadoController@index');

	Route::get('/teste', 'TicketController@teste');
	Route::get('/similaridade', 'TicketController@similaridade');
	Route::get('/ticket/solicitacoes', 'TicketController@solicitacoes');
	Route::get('/ticket/lista', 'TicketController@lista');
	Route::get('/ticket/pesquisar', 'TicketController@pesquisar');
	Route::get('/ticket/pesquisa', 'TicketController@pesquisa');
	Route::get('/ticket', 'TicketController@index');
	Route::get('/ticket/create', 'TicketController@create');
	Route::post('/ticket', 'TicketController@store');
	Route::get('/ticket/{ticket}', 'TicketController@show');
	Route::patch('/ticket/{ticket}/cancelar', 'TicketController@cancelar');
	Route::get('/ticket/{ticket}/edit', 'TicketController@edit');
	Route::patch('/ticket/{ticket}', 'TicketController@update');
	Route::get('/ticket/{ticket}/revisar', 'TicketController@revisar');
	Route::patch('/ticket/{ticket}/aprovar', 'TicketController@aprovar');

	Route::get('/comunicacao', 'ComunicacaoController@index');
	Route::get('/comunicacao/create', 'ComunicacaoController@create');
	Route::post('/comunicacao', 'ComunicacaoController@store');
	Route::post('/comunicacao/outros', 'ComunicacaoController@outros');
	Route::get('/comunicacao/{comunicacao}/delete', 'ComunicacaoController@delete');
	Route::delete('/comunicacao/{comunicacao}', 'ComunicacaoController@destroy');

	Route::get('/empresa', 'EmpresaController@index');
	Route::get('/empresa/create', 'EmpresaController@create');
	Route::post('/empresa', 'EmpresaController@store');
	Route::post('/empresa/outros', 'EmpresaController@outros');
	Route::get('/empresa/{empresa}/delete', 'EmpresaController@delete');
	Route::delete('/empresa/{empresa}', 'EmpresaController@destroy');

	Route::get('/produto', 'ProdutoController@index');
	Route::get('/produto/create', 'ProdutoController@create');
	Route::post('/produto', 'ProdutoController@store');
	Route::post('/produto/outros', 'ProdutoController@outros');
	Route::get('/produto/{produto}/delete', 'ProdutoController@delete');
	Route::delete('/produto/{produto}', 'ProdutoController@destroy');

	Route::get('/publico_alvo', 'PublicoAlvoController@index');
	Route::get('/publico_alvo/create', 'PublicoAlvoController@create');
	Route::post('/publico_alvo', 'PublicoAlvoController@store');
	Route::post('/publico_alvo/outros', 'PublicoAlvoController@outros');
	Route::get('/publico_alvo/{publico_alvo}/delete', 'PublicoAlvoController@delete');
	Route::delete('/publico_alvo/{publico_alvo}', 'PublicoAlvoController@destroy');

	Route::get('/regiao', 'RegiaoController@index');
	Route::get('/regiao/create', 'RegiaoController@create');
	Route::post('/regiao', 'RegiaoController@store');
	Route::post('/regiao/outros', 'RegiaoController@outros');
	Route::get('/regiao/{regiao}/delete', 'RegiaoController@delete');
	Route::delete('/regiao/{regiao}', 'RegiaoController@destroy');

	Route::get('/arquivo', 'ArquivoController@index');
	Route::post('/arquivo', 'ArquivoController@store');
	Route::post('/ticket/{ticket}/arquivo', 'ArquivoController@store');
	Route::delete('/arquivo/{arquivo}', 'ArquivoController@destroy');
	Route::get('/arquivo/{arquivo}/download', 'ArquivoController@download');
	// Route::get('/email/enviar', 'TicketController@email');
});

Auth::routes();

Route::get('/home', 'TicketController@inicio')->name('home');
