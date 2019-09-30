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
        alunosAssociados:[],
        curso_edicao:{},
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
    },
    methods:{
        buscarCursos:function(){
            this.$http.post('/instituicao/cursos',{argumento:this.filtro.curso}).then(
                function(response){
                    this.$set(this,'cursos',response.data);
                },function(response){
                    // alert("Erro");
                }
            )
        },
        editarCurso:function(curso){
            if(curso){
                this.$set(this,'curso_edicao',JSON.parse(JSON.stringify(curso)));
            }else{
                this.$set(this,'curso_edicao',JSON.parse(JSON.stringify(this.curso_padrao)));
            }
            this.$set(this,'alunosAssociados',this.curso_edicao.alunos)
            this.buscarAlunos(this.curso_edicao.id);
        },
        toggleStatus:function(status){
            if(status){
                return 0;
            }
            return 1;
        },
        buscarAlunos:function(curso_id){
            this.$http.post('/instituicao/alunos',{argumento:this.filtro.aluno,curso:curso_id}).then(
                function(response){
                    this.$set(this,'alunos',response.data);
                },function(response){
                    // alert("Erro");
                }
            )
        }
    }
})
