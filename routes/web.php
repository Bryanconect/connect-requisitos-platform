<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsightsController;


//Inicio do Sistema
Route::get('/inicio', 'App\Http\Controllers\RequisitoController@indexinicio');

//Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::get('/novousuario', 'criarusuario')->name('login.criarusuario');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
    Route::post('/solicitar', 'storeusuario')->name('login.storeusuario');

  });
 
//Gestão Usuario
Route::get('/gestaousuario', 'App\Http\Controllers\AdminController@indexgestaousuario')->middleware('auth');
Route::get('/requisitos/gestaousuario/autorizar/{user}', 'App\Http\Controllers\AdminController@autorizarusuario')->middleware('auth');
Route::get('/requisitos/gestaousuario/cancelar/{user}', 'App\Http\Controllers\AdminController@cancelarusuario')->middleware('auth');
Route::get('/requisitos/gestaousuario/tornaradm/{user}', 'App\Http\Controllers\AdminController@tornaradm')->middleware('auth');
Route::get('/requisitos/gestaousuario/removeradm/{user}', 'App\Http\Controllers\AdminController@removeradm')->middleware('auth');
//Gestão Programa
Route::post('/requisitos', 'App\Http\Controllers\AdminController@store')->middleware('auth');
Route::get('/gestaorequisito', 'App\Http\Controllers\AdminController@indexgestaorequisito')->middleware('auth');
Route::get('/gestaorequisito/ativar/{requisitos}', 'App\Http\Controllers\AdminController@ativarrequisito')->middleware('auth');
Route::get('/gestaorequisito/inativar/{requisitos}', 'App\Http\Controllers\AdminController@inativarusuario')->middleware('auth');

//Elicitacao
Route::get('/elicitacao', 'App\Http\Controllers\ElicitacaoController@createelicitacao')->middleware('auth');
Route::post('/elicitacao', 'App\Http\Controllers\ElicitacaoController@storeelicitacao')->middleware('auth');
Route::get('/elicitacao/inicio', 'App\Http\Controllers\ElicitacaoController@indexelicitacao')->middleware('auth');
Route::get('/elicitacao/inicio/{elicitacao}', 'App\Http\Controllers\ElicitacaoController@showelicitacao')->middleware('auth');
Route::get('/elicitacao/inicio/edit/{elicitacao}', 'App\Http\Controllers\ElicitacaoController@editelicitacao')->middleware('auth');
Route::put('/elicitacao/update/{elicitacao}', 'App\Http\Controllers\ElicitacaoController@updateelicitacao')->middleware('auth');
Route::get('/elicitacao/inicio/excluir/{elicitacao}', 'App\Http\Controllers\ElicitacaoController@excluirelicitacao')->middleware('auth');
Route::get('/download/{elicitacao}', 'App\Http\Controllers\ElicitacaoController@download')->middleware('auth');

//Requisito
Route::get('/requisitos/inicio', 'App\Http\Controllers\RequisitoController@index')->middleware('auth');
Route::get('/requisitos/requisitos/inicio', 'App\Http\Controllers\RequisitoController@index')->middleware('auth');
Route::get('/requisitos/{requisitos}/requisitos/inicio', 'App\Http\Controllers\RequisitoController@index')->middleware('auth');
Route::get('/requisitos', 'App\Http\Controllers\RequisitoController@create')->middleware('auth');
//Historia
Route::get('/requisitos/criarhistoria/{requisitos}', 'App\Http\Controllers\RequisitoController@createhistoria')->middleware('auth');
Route::put('/requisitos/criarhistoria', 'App\Http\Controllers\RequisitoController@storeHistoria')->middleware('auth');
//Gestão História
Route::get('/requisitos/gestaohistoria/{historias}', 'App\Http\Controllers\RequisitoController@indexgestaohistoria')->middleware('auth');
Route::get('/requisitos/gestaohistoria/editarhistoria/{historias}', 'App\Http\Controllers\RequisitoController@edithistoria')->middleware('auth');
Route::put('/requisitos/gestaohistoria/editarhistoria/alterarhistoria/{historias}', 'App\Http\Controllers\RequisitoController@updatehistoria')->middleware('auth');
Route::get('/requisitos/gestaohistoria/homologarhistoria/{historias}', 'App\Http\Controllers\RequisitoController@homologarhistoria')->middleware('auth');
Route::get('/requisitos/gestaohistoria/cancelarhistoria/{historias}', 'App\Http\Controllers\RequisitoController@cancelarhistoria')->middleware('auth');
//Gestão Versão
Route::get('/requisitos/gestaoversao/{historias}', 'App\Http\Controllers\RequisitoController@indexgestaoversao')->middleware('auth');
Route::get('/requisitos/gestaoversao/visualizar/{historias}', 'App\Http\Controllers\RequisitoController@showhistoria')->middleware('auth');
Route::get('/requisitos/gestaoversao/imprimir/{historias}', 'App\Http\Controllers\RequisitoController@geraPdf')->middleware('auth');

//Insights
Route::get('/gestaohistoria/consultarinsights/{id}', [InsightsController::class, 'getInsightsForRequirement'])->middleware('auth');

//Relatórios
Route::get('/relatorios', 'App\Http\Controllers\ReportController@relatorios')->middleware('auth');
Route::post('/relatorios/tipogeracao', 'App\Http\Controllers\ReportController@tipogeracao')->middleware('auth');

