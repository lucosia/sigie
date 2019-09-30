@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/instituicao_home.js') }}" defer></script>
@endsection


@section('content')
<div class="container" id="instituicao_home">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width: 100%; padding: 20px;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="cursos-tab" data-toggle="tab" href="#cursos" role="tab" aria-controls="cursos" aria-selected="true">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="alunos-tab" data-toggle="tab" href="#alunos" role="tab" aria-controls="alunos" aria-selected="false">Alunos</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cursos" role="tabpanel" aria-labelledby="cursos-tab">
                        @include('instituicao.partes.cursos_corpo')
                    </div>
                    <div class="tab-pane fade" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">
                        @include('instituicao.partes.alunos_corpo')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
