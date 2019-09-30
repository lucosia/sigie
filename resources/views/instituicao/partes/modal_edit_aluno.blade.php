<div class="modal fade" id="modalEditAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="aluno_nome" v-model="aluno_edicao.nome">
                    </div>
                    <div class="col-md-3">
                        <label>CPF</label>
                        <input type="text" class="form-control" name="aluno_cpf" v-model="aluno_edicao.cpf">
                    </div>
                    <div class="col-md-3">
                        <label>Nascimento</label>
                        <input type="date" class="form-control" name="aluno_nascimento" v-model="aluno_edicao.data_de_nascimento">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label>Endereço</label>
                        <input type="text" class="form-control" name="aluno_endereco" v-model="aluno_edicao.endereco">
                    </div>
                    <div class="col-md-2">
                        <label>Numero</label>
                        <input type="text" class="form-control" name="aluno_endereco_numero" v-model="aluno_edicao.numero">
                    </div>
                    <div class="col-md-4">
                        <label>Bairro</label>
                        <input type="text" class="form-control" name="aluno_bairro" v-model="aluno_edicao.bairro">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Cidade</label>
                        <input type="text" class="form-control" name="aluno_cidade" v-model="aluno_edicao.cidade">
                    </div>
                    <div class="col-md-2">
                        <label>UF</label>
                        <input type="text" class="form-control" name="aluno_endereco_numero" v-model="aluno_edicao.uf">
                    </div>
                    <div class="col-md-3">
                        <label>Celular</label>
                        <input type="text" class="form-control" name="aluno_celular" v-model="aluno_edicao.celular">
                    </div>
                    <div class="col-md-3">
                        <label>Status</label><br>
                        <span style="padding-right:7px;">@{{aluno_edicao.status | nomeStatus}}</span>
                            <i :class="['fa', aluno_edicao.status == 1?'fa-toggle-on':'fa-toggle-off']"></i>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-6">
                        <label>Curso</label>
                        <button type="button" class="btn btn-primary btn-sm " style="margin-left: 1rem;" name="button" @click="alterarCursoAluno()">@{{alterandoAlunoCurso?'Salvar':'Alterar'}}</button>
                        <p v-if="!alterandoAlunoCurso" >@{{aluno_edicao.curso.nome}} - @{{aluno_edicao.curso.duracao}} mes(es) </p>
                        <select v-if="alterandoAlunoCurso" class="form-control" name="" v-model="aluno_edicao.curso_id">
                            <option v-for="curso in cursos" :value="curso.id">@{{curso.nome}}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvarAluno()">Salvar</button>
            </div>
        </div>
    </div>
</div>
