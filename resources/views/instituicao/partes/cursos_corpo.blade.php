<div class="row" >
    <div class="col-md-5">
        <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro_cursos" v-model="filtro.curso" @keyup="buscarCursos()">
    </div>
    <div class="offset-md-5 col-md-2">
        <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalEditCurso" @click="editarCurso()">Novo Curso <i class="fa fa-plus"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 scroll-y"  style="height: 300px;">
        <table class="table">
            <tbody>
                <tr v-for="curso in cursos">
                    <td>@{{curso.nome}}</td>
                    <td>@{{curso.status | nomeStatus}}</td>
                    <td>@{{curso.alunos.length}} Alunos Cadastrados</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modalEditCurso" @click="editarCurso(curso)" ><i class="fa fa-edit"></i></a>
                        <a href="#" @click="deletarCurso(curso)" style="margin-left: 1rem; color: red;" ><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('instituicao.partes.modal_edit_curso')
