<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Curso;
use App\Model\Aluno;

class InstituicaoController extends Controller
{
    public function buscarCursos(Request $request){
        $arg = $request->input('argumento');
        return Curso::where('instituicao_id',$request->user()->instituicao_id)
                    ->where(function($query)use($arg){
                        if($arg){
                            $query->where('nome','like','%'.$arg.'%');
                        }
                    })->with('alunos')
                    ->orderBy('nome')
                    ->orderBy('status')
                    ->get();
    }

    public function buscarAlunos(Request $request){
        $arg = $request->input('argumento');
        $curso = $request->input('argumento');
        return Aluno::where('instituicao_id',$request->user()->instituicao_id)
                    ->where(function($query)use($arg,$curso){
                        if($arg){
                            $query->where('nome','like','%'.$arg.'%');
                        }
                        if($curso){
                            $query->where('curso_id',$curso);
                            $query->orderBy('curso_id','desc');
                        }
                    })->orderBy('nome')
                    ->orderBy('status')
                    ->get();
    }
}
