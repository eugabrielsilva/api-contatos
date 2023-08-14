const app = angular.module('app', [], function($httpProvider) {
    $httpProvider.defaults.headers.post = {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
});

app.directive('ngEnter', function() {
    return function($scope, $element, $attrs) {
        $element.bind('keydown keypress', function(event) {
            if(event.which === 13 && !event.shiftKey && !event.altKey && !event.ctrlKey) {
                $scope.$apply(function() {
                    $scope.$eval($attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});

app.controller('controller', function($scope, $http, $httpParamSerializer) {

    $scope.loading = true;

    // Lista todas as pessoas do BD
    $scope.listarPessoas = function() {
        $http.get('pessoas').then(result => {
            $scope.pessoas = result.data.dados;
            $scope.loading = false;
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao obter as informações!',
                'error'
            );
        });
    }

    // Prepara criação de nova pessoa
    $scope.novaPessoa = function() {
        $scope.pessoaCriar = {};
        setTimeout(() => {
            $('#criar_nome').focus();
        }, 500);
    }

    // Salva nova pessoa no BD
    $scope.criarPessoa = function() {
        if(!$scope?.pessoaCriar?.nome?.length) {
            Swal.fire(
                'Oops!',
                'Nome não pode estar em branco!',
                'warning'
            );
            return;
        }

        $scope.loading = true;

        $http.post('pessoas', $httpParamSerializer($scope.pessoaCriar)).then(result => {
            $scope.loading = false;
            if(result.data.status) {
                Swal.fire(
                    'Sucesso!',
                    'Pessoa criada com sucesso!',
                    'success'
                );

                $('#criar').modal('hide');

                $scope.listarPessoas();
            } else {
                Swal.fire(
                    'Oops!',
                    'Ocorreu um erro ao salvar!',
                    'error'
                );
            }
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao salvar!',
                'error'
            );
        });
    }

    // Prepara edição de pessoa
    $scope.editarPessoa = function(pessoa) {
        $scope.pessoaEditar = angular.copy(pessoa);
        setTimeout(() => {
            $('#editar_nome').focus();
        }, 500);
    }

    // Salva edições no DB
    $scope.salvarPessoa = function() {
        if(!$scope?.pessoaEditar?.nome?.length) {
            Swal.fire(
                'Oops!',
                'Nome não pode estar em branco!',
                'warning'
            );
            return;
        }

        $scope.loading = true;

        $http.put('pessoas/' + $scope.pessoaEditar.id, $httpParamSerializer($scope.pessoaEditar)).then(result => {
            $scope.loading = false;
            if(result.data.status) {
                Swal.fire(
                    'Sucesso!',
                    'Pessoa editada com sucesso!',
                    'success'
                );

                $('#editar').modal('hide');

                $scope.listarPessoas();
            } else {
                Swal.fire(
                    'Oops!',
                    'Ocorreu um erro ao salvar!',
                    'error'
                );
            }
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao salvar!',
                'error'
            );
        });
    }

    // Exclui uma pessoa do BD
    $scope.excluirPessoa = function(pessoa) {
        Swal.fire({
            title: 'Excluir pessoa ' + pessoa.nome + '?',
            text: 'Esta ação é irreversível!',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Sim, excluir',
            denyButtonText: 'Não',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((answer) => {
            if(answer.isConfirmed) {
                $scope.loading = true;
                $http.delete('pessoas/' + pessoa.id).then(result => {
                    $scope.loading = false;
                    if(result.data.status) {
                        Swal.fire(
                            'Sucesso!',
                            'Pessoa excluída com sucesso!',
                            'success'
                        );

                        $scope.listarPessoas();
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Ocorreu um erro ao excluir!',
                            'error'
                        );
                    }
                }).catch(() => {
                    $scope.loading = false;
                    Swal.fire(
                        'Oops!',
                        'Ocorreu um erro ao excluir!',
                        'error'
                    );
                });
            }
        })
    }

    // Carrega os contatos de uma pessoa
    $scope.carregarPessoa = function(id) {
        $scope.loading = true;
        $http.get('../pessoas/' + id).then(result => {
            $scope.pessoa = result.data.dados;
            $scope.loading = false;
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao obter as informações!',
                'error'
            );
        });
    }

    // Prepara criação de contato
    $scope.novoContato = function() {
        $scope.contatoCriar = {};
        setTimeout(() => {
            $('#criar_nome').focus();
        }, 500);
    }

    // Cria contato no DB
    $scope.criarContato = function() {
        if(!$scope?.contatoCriar?.contato?.length) {
            Swal.fire(
                'Oops!',
                'Contato não pode estar em branco!',
                'warning'
            );
            return;
        }

        if(!$scope?.contatoCriar?.tipo?.length) {
            Swal.fire(
                'Oops!',
                'Selecione um tipo de contato!',
                'warning'
            );
            return;
        }

        $scope.loading = true;

        $http.post('../contatos/' + $scope.pessoa.id, $httpParamSerializer($scope.contatoCriar)).then(result => {
            $scope.loading = false;
            if(result.data.status) {
                Swal.fire(
                    'Sucesso!',
                    'Contato criado com sucesso!',
                    'success'
                );

                $('#criar').modal('hide');

                $scope.carregarPessoa($scope.pessoa.id);
            } else {
                Swal.fire(
                    'Oops!',
                    'Ocorreu um erro ao salvar!',
                    'error'
                );
            }
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao salvar!',
                'error'
            );
        });
    }

    // Prepara edição de contato
    $scope.editarContato = function(contato) {
        $scope.contatoEditar = angular.copy(contato);
        setTimeout(() => {
            $('#editar_nome').focus();
        }, 500);
    }

    // Salva edições no DB
    $scope.salvarContato = function() {
        if(!$scope?.contatoEditar?.contato?.length) {
            Swal.fire(
                'Oops!',
                'Contato não pode estar em branco!',
                'warning'
            );
            return;
        }

        if(!$scope?.contatoEditar?.tipo?.length) {
            Swal.fire(
                'Oops!',
                'Selecione um tipo de contato!',
                'warning'
            );
            return;
        }

        $scope.loading = true;

        $http.put('../contatos/' + $scope.contatoEditar.id, $httpParamSerializer($scope.contatoEditar)).then(result => {
            $scope.loading = false;
            if(result.data.status) {
                Swal.fire(
                    'Sucesso!',
                    'Contato editado com sucesso!',
                    'success'
                );

                $('#editar').modal('hide');

                $scope.carregarPessoa($scope.pessoa.id);
            } else {
                Swal.fire(
                    'Oops!',
                    'Ocorreu um erro ao salvar!',
                    'error'
                );
            }
        }).catch(() => {
            $scope.loading = false;
            Swal.fire(
                'Oops!',
                'Ocorreu um erro ao salvar!',
                'error'
            );
        });
    }

    // Exclui contato
    $scope.excluirContato = function(contato) {
        Swal.fire({
            title: 'Excluir contato ' + contato.contato + '?',
            text: 'Esta ação é irreversível!',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Sim, excluir',
            denyButtonText: 'Não',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((answer) => {
            if(answer.isConfirmed) {
                $scope.loading = true;
                $http.delete('../contatos/' + contato.id).then(result => {
                    $scope.loading = false;
                    if(result.data.status) {
                        Swal.fire(
                            'Sucesso!',
                            'Contato excluído com sucesso!',
                            'success'
                        );

                        $scope.carregarPessoa($scope.pessoa.id);
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Ocorreu um erro ao excluir!',
                            'error'
                        );
                    }
                }).catch(() => {
                    $scope.loading = false;
                    Swal.fire(
                        'Oops!',
                        'Ocorreu um erro ao excluir!',
                        'error'
                    );
                });
            }
        })
    }

});