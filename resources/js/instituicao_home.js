module.exports = {
  mode: 'production'
}
const app = new Vue({
    el: '#instituicao_home',
    data: {
        cursos:[],
        alunos:[],

        filtro:{
            curso:'',
            aluno:'',
        },
        curso_padrao:{
            id:null,
            nome:'',
            duracao:1,
            instituicao_id:null,
            status:1,
            alunos:[],
        },
        aluno_padrao:{
            id:null,
            nome:null,
            cpf:null,
            data_de_nascimento:null,
            celular:null,
            endereco:null,
            numero:null,
            bairro:null,
            cidade:null,
            uf:null,
            instituicao_id:null,
            curso_id:null,
            status:1,
            curso:{},
        },
        alunos_associados:[],
        curso_edicao:{},
        aluno_edicao:{curso:{},},
        alterandoAlunoCurso:false,
        erro:null,
    },
    filters:{
        nomeStatus:function(data){
            if(data == 1){
                return "Ativo";
            }
            return "Inativo";
        },
    },
    mounted:function(){
        this.buscarCursos();
        this.buscarAlunos();
    },
    methods:{
        buscarCursos:function(){
            this.$http.post('/instituicao/cursos',{argumento:this.filtro.curso}).then(
                function(response){
                    this.$set(this,'cursos',response.data);
                },function(response){
                    alert("Erro");
                }
            )
        },
        buscarAlunos:function(curso_id){
            this.$http.post('/instituicao/alunos',{argumento:this.filtro.aluno,curso:curso_id}).then(
                function(response){
                    this.$set(this,'alunos',response.data);
                },function(response){
                    alert("Erro");
                }
            )
        },
        editarCurso:function(curso){
            this.$set(this,'curso_edicao',JSON.parse(JSON.stringify(curso?curso:this.curso_padrao)));
            this.$set(this,'alunos_associados',this.curso_edicao.alunos.map((a)=>{return a.id}))
            this.buscarAlunos(this.curso_edicao.id);
        },
        editarAluno:function(aluno){
            this.$set(this,'aluno_edicao',JSON.parse(JSON.stringify(aluno?aluno:this.aluno_padrao)));
            if(!aluno){this.alterandoAlunoCurso = true};
        },
        toggleStatus:function(status){
            if(status){
                return 0;
            }
            return 1;
        },
        alterarCursoAluno:function(){
            if(this.alterandoAlunoCurso){
                this.aluno_edicao.curso = this.cursos.filter((c)=>{return c.id == this.aluno_edicao.curso_id}).pop();
            }
            this.alterandoAlunoCurso = this.toggleStatus(this.alterandoAlunoCurso);
        },
        salvarCurso:function(){
            this.$http.post('/instituicao/salvarCurso',{curso:this.curso_edicao,alunos:this.alunos_associados}).then(
                function(response){
                    this.buscarCursos();
                    alert("Sucesso!");
                    if(this.curso_edicao.id){
                        $('#modalEditCurso').modal('hide')
                    }else{
                        this.editarCurso();
                    }
                },function(response){
                    alert("Erro");
                }
            )
        },
        salvarAluno:function(){
            this.$http.post('/instituicao/salvarAluno',{aluno:this.aluno_edicao}).then(
                function(response){
                    this.buscarAlunos();
                    alert("Sucesso!");
                    if(this.aluno_edicao.id){
                        $('#modalEditaluno').modal('hide')
                    }else{
                        this.editarAluno();
                    }
                },function(response){
                    alert("Erro");
                }
            )
        },
        deletarCurso:function(curso){
            let conf = confirm("Tem certeza que deseja excluir este curso?")
            if(!conf){return 0;}

            if(curso.alunos.length > 0){
                let conf_desativar = confirm("Este curso possui "+curso.alunos.length+" alunos cadastrados, portanto será desativado. Continuar?");
                if(!conf_desativar){return 0;}
            }
            this.$http.post('/instituicao/deletarCurso',{curso:curso.id}).then(
                function(response){
                    this.buscarCursos();
                    alert("Sucesso!");
                },function(response){
                    alert("Erro");
                }
            )
        },
        desativarAluno:function(aluno){
            let conf = confirm("Tem certeza que deseja desativar este aluno?")
            if(!conf){return 0;}

            this.$http.post('/instituicao/desativarAluno',{aluno:aluno}).then(
                function(response){
                    this.buscarAlunos();
                    alert("Sucesso!");
                },function(response){
                    alert("Erro");
                }
            )
        }
    }
})
