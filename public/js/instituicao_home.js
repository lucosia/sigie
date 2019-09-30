/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/instituicao_home.js":
/*!******************************************!*\
  !*** ./resources/js/instituicao_home.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = {
  mode: 'production'
};
var app = new Vue({
  el: '#instituicao_home',
  data: {
    cursos: [],
    alunos: [],
    filtro: {
      curso: '',
      aluno: ''
    },
    curso_padrao: {
      id: null,
      nome: '',
      duracao: 1,
      instituicao_id: null,
      status: 1,
      alunos: []
    },
    aluno_padrao: {
      id: null,
      nome: null,
      cpf: null,
      data_de_nascimento: null,
      celular: null,
      endereco: null,
      numero: null,
      bairro: null,
      cidade: null,
      uf: null,
      instituicao_id: null,
      curso_id: null,
      status: 1,
      curso: {}
    },
    alunos_associados: [],
    curso_edicao: {},
    aluno_edicao: {
      curso: {}
    },
    alterandoAlunoCurso: false,
    erro: null
  },
  filters: {
    nomeStatus: function nomeStatus(data) {
      if (data == 1) {
        return "Ativo";
      }

      return "Inativo";
    }
  },
  mounted: function mounted() {
    this.buscarCursos();
    this.buscarAlunos();
  },
  methods: {
    buscarCursos: function buscarCursos() {
      this.$http.post('/instituicao/cursos', {
        argumento: this.filtro.curso
      }).then(function (response) {
        this.$set(this, 'cursos', response.data);
      }, function (response) {
        alert("Erro");
      });
    },
    buscarAlunos: function buscarAlunos(curso_id) {
      this.$http.post('/instituicao/alunos', {
        argumento: this.filtro.aluno,
        curso: curso_id
      }).then(function (response) {
        this.$set(this, 'alunos', response.data);
      }, function (response) {
        alert("Erro");
      });
    },
    editarCurso: function editarCurso(curso) {
      this.$set(this, 'curso_edicao', JSON.parse(JSON.stringify(curso ? curso : this.curso_padrao)));
      this.$set(this, 'alunos_associados', this.curso_edicao.alunos.map(function (a) {
        return a.id;
      }));
      this.buscarAlunos(this.curso_edicao.id);
    },
    editarAluno: function editarAluno(aluno) {
      this.$set(this, 'aluno_edicao', JSON.parse(JSON.stringify(aluno ? aluno : this.aluno_padrao)));

      if (!aluno) {
        this.alterandoAlunoCurso = true;
      }

      ;
    },
    toggleStatus: function toggleStatus(status) {
      if (status) {
        return 0;
      }

      return 1;
    },
    alterarCursoAluno: function alterarCursoAluno() {
      var _this = this;

      if (this.alterandoAlunoCurso) {
        this.aluno_edicao.curso = this.cursos.filter(function (c) {
          return c.id == _this.aluno_edicao.curso_id;
        }).pop();
      }

      this.alterandoAlunoCurso = this.toggleStatus(this.alterandoAlunoCurso);
    },
    salvarCurso: function salvarCurso() {
      this.$http.post('/instituicao/salvarCurso', {
        curso: this.curso_edicao,
        alunos: this.alunos_associados
      }).then(function (response) {
        this.buscarCursos();
        alert("Sucesso!");

        if (this.curso_edicao.id) {
          $('#modalEditCurso').modal('hide');
        } else {
          this.editarCurso();
        }
      }, function (response) {
        alert("Erro");
      });
    },
    salvarAluno: function salvarAluno() {
      this.$http.post('/instituicao/salvarAluno', {
        aluno: this.aluno_edicao
      }).then(function (response) {
        this.buscarAlunos();
        alert("Sucesso!");

        if (this.aluno_edicao.id) {
          $('#modalEditaluno').modal('hide');
        } else {
          this.editarAluno();
        }
      }, function (response) {
        alert("Erro");
      });
    },
    deletarCurso: function deletarCurso(curso) {
      var conf = confirm("Tem certeza que deseja excluir este curso?");

      if (!conf) {
        return 0;
      }

      if (curso.alunos.length > 0) {
        var conf_desativar = confirm("Este curso possui " + curso.alunos.length + " alunos cadastrados, portanto será desativado. Continuar?");

        if (!conf_desativar) {
          return 0;
        }
      }

      this.$http.post('/instituicao/deletarCurso', {
        curso: curso.id
      }).then(function (response) {
        this.buscarCursos();
        alert("Sucesso!");
      }, function (response) {
        alert("Erro");
      });
    },
    desativarAluno: function desativarAluno(aluno) {
      var conf = confirm("Tem certeza que deseja desativar este aluno?");

      if (!conf) {
        return 0;
      }

      this.$http.post('/instituicao/desativarAluno', {
        aluno: aluno
      }).then(function (response) {
        this.buscarAlunos();
        alert("Sucesso!");
      }, function (response) {
        alert("Erro");
      });
    }
  }
});

/***/ }),

/***/ 2:
/*!************************************************!*\
  !*** multi ./resources/js/instituicao_home.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/julia/Projetos/sigie/resources/js/instituicao_home.js */"./resources/js/instituicao_home.js");


/***/ })

/******/ });