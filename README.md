## API REST Contatos
Teste para recrutamento, consiste em uma API REST com implementação de CRUD para uma listagem de pessoas e seus contatos. Desenvolvida utilizando PHP e [Glowie Framework](https://eugabrielsilva.tk/glowie) no backend (framework de minha autoria). O front-end foi desenvolvido utilizando AngularJS e Bootstrap.

Executar em ambiente PHP, criar banco de dados `api-contatos` e rodar comando `php firefly migrate` ou importar o dump do banco MySQL no arquivo `sql.sql` para criação das tabelas antes da execução. As configurações do banco de dados e credenciais estão no arquivo `.env`.

### Demo
A aplicação web pode ser visualizada em: https://eugabrielsilva.tk/api-contatos

### Endpoints

`GET pessoas`\
Retorna todas as pessoas cadastradas e seus contatos. Parâmetro opcional `busca` faz uma busca pelo nome.

`GET pessoas/id`\
Retorna uma única pessoa e seus contatos baseado no ID.

`POST pessoas`\
Cadastra uma nova pessoa no banco de dados. Parâmetro `nome` obrigatório.

`PUT pessoas/id`\
Edita o cadastro de uma pessoa existente baseado no ID. Parâmetro `nome` obrigatório.

`DELETE pessoas/id`\
Exclui uma pessoa e todos os seus contatos do banco de dados baseado no ID.

`POST contatos/id`\
Cria um novo contato para uma pessoa atrelado ao seu ID. Parâmetros `contato` e `tipo` obrigatórios.

`PUT contatos/id`\
Edita um contato existente baseado no ID. Parâmetros `contato` e `tipo` obrigatórios.

`DELETE contatos/id`\
Exclui um contato existente baseado no ID.