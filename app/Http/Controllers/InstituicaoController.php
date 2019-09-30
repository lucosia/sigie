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
        $curso = $request->input('curso_id');
        return Aluno::where('instituicao_id',$request->user()->instituicao_id)
                    ->where(function($query)use($arg){
                        if($arg){
                            $query->where('nome','like','%'.$arg.'%')->orWhere('cpf','like','%'.$arg.'%');
                        }
                    })->where(function($query)use($curso){
                        if($curso){
                            $query->where('curso_id',$curso);
                            $query->orderBy('curso_id','desc');
                        }
                    })->with('curso')
                    ->orderBy('status','desc')
                    ->orderBy('nome')
                    ->get();
    }

    public function salvarCurso(Request $request){
        $curso = $request->input('curso');
        $alunos = $request->input('alunos');
        if($curso['id']){
            Curso::where('id',$curso['id'])->update([
                'nome'=>$curso['nome'],
                'duracao'=>$curso['duracao'],
            ]);
        }else{
            unset($curso['alunos']);
            $curso['instituicao_id'] = $request->user()->instituicao_id;
            $curso = Curso::create($curso);
        }
        if(count($alunos) > 0){
            Aluno::whereIn('id',$alunos)->update(['curso_id'=>$curso['id']]);
        }
    }
    public function deletarCurso(Request $request){
        $curso = $request->input('curso');
        $alunos = Aluno::where('curso_id',$curso)->count();
        if($alunos > 0){
            Curso::where('id',$curso)->update(['status'=>0]);
        }else{
            Curso::where('id',$curso)->delete();
        }
    }
    public function salvarAluno(Request $request){
        $aluno = $request->input('aluno');
        if($aluno['id']){
            Aluno::where('id',$aluno['id'])->update([
                'nome'=>$aluno['nome'],
                'cpf'=>$aluno['cpf'],
                'data_de_nascimento'=>$aluno['data_de_nascimento'],
                'celular'=>$aluno['celular'],
                'endereco'=>$aluno['endereco'],
                'numero'=>$aluno['numero'],
                'bairro'=>$aluno['bairro'],
                'cidade'=>$aluno['cidade'],
                'uf'=>$aluno['uf'],
                'curso_id'=>$aluno['curso_id'],
            ]);
        }else{
            unset($aluno['curso']);
            $aluno['instituicao_id'] = $request->user()->instituicao_id;
            Aluno::create($aluno);
        }
    }
    public function desativarAluno(Request $request){
        $alunoId = $request->input('aluno');
        Aluno::where('id',$alunoId)->update(['status'=>0]);
    }
}
