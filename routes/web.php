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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@instituicao_home')->name('home');

Route::prefix('instituicao')->group(function () {
    Route::post('cursos', 'InstituicaoController@buscarCursos')->name('instituicao.cursos');
    Route::post('alunos', 'InstituicaoController@buscarAlunos')->name('instituicao.alunos');
    Route::post('salvarCurso', 'InstituicaoController@salvarCurso')->name('instituicao.salvarCurso');
    Route::post('salvarAluno', 'InstituicaoController@salvarAluno')->name('instituicao.salvarAluno');
    Route::post('deletarCurso', 'InstituicaoController@deletarCurso')->name('instituicao.deletarCurso');
    Route::post('desativarAluno', 'InstituicaoController@desativarAluno')->name('instituicao.desativarAluno');
});
