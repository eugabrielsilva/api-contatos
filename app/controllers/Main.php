<?php

namespace Glowie\Controllers;

use Glowie\Core\Http\Controller;
use Glowie\Models\Contatos;
use Glowie\Models\Pessoas;

class Main extends Controller
{

    /**
     * Endpoint pessoas.
     */
    public function pessoas()
    {
        // Chama a função correspondente de acordo com o método chamado
        switch ($this->request->getMethod()) {
            case 'GET':
            default:
                $this->listarPessoas();
                break;

            case 'POST':
                $this->criarPessoa();
                break;

            case 'PUT':
                $this->editarPessoa();
                break;

            case 'DELETE':
                $this->deletarPessoa();
                break;
        }
    }

    private function listarPessoas()
    {
        // Verifica por consulta única
        if (!empty($this->params->id)) {
            $pessoasModel = new Pessoas();
            $pessoa = $pessoasModel->obter($this->params->id);
            if (!$pessoa) return $this->fail('Pessoa não encontrada!');

            // Retorna objeto de resposta
            // Retorna objeto de resposta
            return $this->response->setJson([
                'status' => true,
                'dados' => $pessoa
            ]);
        } else {
            // Lista todas as pessoas
            $pessoasModel = new Pessoas();
            $pessoas = $pessoasModel->listar($this->request->busca);

            // Retorna objeto de resposta
            return $this->response->setJson([
                'status' => true,
                'dados' => $pessoas
            ]);
        }
    }

    private function criarPessoa()
    {
        // Valida nome vazio
        if (empty($this->request->nome)) return $this->fail('Nome não pode estar em branco!');

        // Cria instância do model
        $pessoasModel = new Pessoas([
            'nome' => $this->request->nome,
            'contatos' => []
        ]);

        // Salva pessoa no DB
        $pessoasModel->save();

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'dados' => $pessoasModel->toArray()
        ]);
    }

    private function editarPessoa()
    {
        // Valida id vazio
        if (empty($this->params->id)) return $this->fail('ID da pessoa não informado!');

        // Obtém dados da requisição
        $data = [];
        parse_str($this->request->getBody(), $data);

        // Valida nome vazio
        if (empty($data['nome'])) return $this->fail('Nome não pode estar em branco!');

        // Procura pessoa no DB
        $pessoasModel = new Pessoas();
        $pessoa = $pessoasModel->findAndFill($this->params->id);
        if (!$pessoa) return $this->fail('Pessoa não encontrada!');

        // Edita dados da pessoa
        $pessoasModel->nome = $data['nome'];
        $pessoasModel->save();

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'dados' => $pessoasModel->toArray()
        ]);
    }

    private function deletarPessoa()
    {
        // Valida id vazio
        if (empty($this->params->id)) return $this->fail('ID da pessoa não informado!');

        // Procura pessoa no DB
        $pessoasModel = new Pessoas();
        $pessoa = $pessoasModel->find($this->params->id);
        if (!$pessoa) return $this->fail('Pessoa não encontrada!');

        // Deleta todos os contatos da pessoa do DB
        $contatosModel = new Contatos();
        $contatosModel->dropBy('id_pessoa', $this->params->id);

        // Deleta pessoa do DB
        $pessoasModel->drop($this->params->id);

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'message' => 'Pessoa excluída com sucesso!'
        ]);
    }

    /**
     * Endpoint contatos.
     */
    public function contatos()
    {
        // Chama a função correspondente de acordo com o método chamado
        switch ($this->request->getMethod()) {
            case 'POST':
                $this->criarContato();
                break;

            case 'PUT':
                $this->editarContato();
                break;

            case 'DELETE':
                $this->deletarContato();
                break;
        }
    }

    private function criarContato()
    {
        // Valida id vazio
        if (empty($this->params->id)) return $this->fail('ID da pessoa não informado!');

        // Valida contato vazio
        if (empty($this->request->contato)) return $this->fail('Contato não pode estar em branco!');

        // Valida tipo vazio
        if (empty($this->request->tipo)) return $this->fail('Tipo não pode estar em branco!');

        // Procura pessoa no DB
        $pessoasModel = new Pessoas();
        $pessoa = $pessoasModel->find($this->params->id);
        if (!$pessoa) return $this->fail('Pessoa não encontrada!');

        // Cria instância do model
        $contatosModel = new Contatos([
            'id_pessoa' => $this->params->id,
            'contato' => $this->request->contato,
            'tipo' => $this->request->tipo
        ]);

        // Salva pessoa no DB
        $contatosModel->save();

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'dados' => $contatosModel->toArray()
        ]);
    }

    private function editarContato()
    {
        // Valida id vazio
        if (empty($this->params->id)) return $this->fail('ID do contato não informado!');

        // Obtém dados da requisição
        $data = [];
        parse_str($this->request->getBody(), $data);

        // Valida contato vazio
        if (empty($data['contato'])) return $this->fail('Contato não pode estar em branco!');

        // Valida tipo vazio
        if (empty($data['tipo'])) return $this->fail('Tipo não pode estar em branco!');

        // Procura contato no DB
        $contatosModel = new Contatos();
        $contato = $contatosModel->findAndFill($this->params->id);
        if (!$contato) return $this->fail('Contato não encontrado!');

        // Edita dados do contato
        $contatosModel->contato = $data['contato'];
        $contatosModel->tipo = $data['tipo'];
        $contatosModel->save();

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'dados' => $contatosModel->toArray()
        ]);
    }

    private function deletarContato()
    {
        // Valida id vazio
        if (empty($this->params->id)) return $this->fail('ID do contato não informado!');

        // Procura contato no DB
        $contatosModel = new Contatos();
        $contato = $contatosModel->find($this->params->id);
        if (!$contato) return $this->fail('Contato não encontrado!');

        // Deleta contato do DB
        $contatosModel->drop($this->params->id);

        // Retorna objeto de resposta
        return $this->response->setJson([
            'status' => true,
            'message' => 'Contato excluído com sucesso!'
        ]);
    }

    private function fail(string $message)
    {
        $this->response->fail();
        return $this->response->setJson([
            'status' => false,
            'mensagem' => $message
        ]);
    }
}
