<div class="row" >
    <div class="col-md-5">
        <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro_cursos" v-model="filtro.aluno" @keyup="buscarAlunos()">
    </div>
    <div class="offset-md-4 col-md-3">
        <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalEditAluno" @click="editarAluno()">Cadastrar Novo Aluno <i class="fa fa-plus"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 scroll-y"  style="height: 300px;">
        <table class="table">
            <tbody>
                <tr v-for="aluno in alunos">
                    <td>@{{aluno.nome}}</td>
                    <td>@{{aluno.cpf}}</td>
                    <td>@{{aluno.status | nomeStatus}}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modalEditAluno" @click="editarAluno(aluno)" ><i class="fa fa-edit"></i></a>
                        <a href="#" @click="desativarAluno(aluno.id)" style="margin-left: 1rem; color: red;" ><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('instituicao.partes.modal_edit_aluno')
