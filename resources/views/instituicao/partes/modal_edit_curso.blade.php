<div class="modal fade" id="modalEditCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6" style="border-color: lightblue; border-right-style: solid;">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="curso_nome" v-model="curso_edicao.nome">
                            </div>
                        </div>
                        <div class="row" style="padding-top: 50px;">
                            <div class="col-md-8">
                                <label>Duração (meses)</label>
                                <input type="number" class="form-control" name="duracao_curso" v-model="curso_edicao.duracao" min="1">
                            </div>
                            <div class="col-md-4">
                                <label>Status</label><br>
                                <span style="padding-right:7px;">@{{curso_edicao.status | nomeStatus}}</span>
                                    <i :class="['fa', curso_edicao.status == 1?'fa-toggle-on':'fa-toggle-off']"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label> Associar alunos</label>
                        <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro_alunos" v-model="filtro.aluno" @keyup="buscarAlunos(curso_edicao.id)">
                        <table class="table" >
                            <thead style="display: block; ">
                                <tr>
                                    <th><i class="far fa-check-square"></i></th>
                                    <th style="width:50%;">Nome</th>
                                    <th style="width:50%;">CPF</th>
                                    <th style="width:50%;">Status</th>
                                </tr>
                            </thead>
                            <tbody class="scroll-y" style="display: block; height: 150px;">
                                <tr v-for="aluno in alunos">
                                    <td><input type="checkbox" v-model="alunos_associados" :value="aluno.id" :disabled="aluno.curso_id == curso_edicao.id || curso_edicao.status == 0 || aluno.status == 0"> </td>
                                    <td style="width:50%;">@{{aluno.nome}}</td>
                                    <td style="width:50%;">@{{aluno.cpf}}</td>
                                    <td style="width:50%;">@{{aluno.status | nomeStatus}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvarCurso()">Salvar</button>
            </div>
        </div>
    </div>
</div>
