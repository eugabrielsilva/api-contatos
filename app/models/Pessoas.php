<?php

namespace Glowie\Models;

use Glowie\Core\Database\Model;

class Pessoas extends Model
{
    protected $_timestamps = true;
    protected $_fields = ['id', 'nome'];
    protected $_updatable = ['id', 'nome'];

    /**
     * Realiza a listagem de pessoas e seus contatos.
     * @param string|null $busca (Opcional) Buscar pelo nome.
     * @return array Retorna um array de pessoas.
     */
    public function listar(?string $busca = null): array
    {
        $contatosModel = new Contatos();

        if (!empty($busca)) $this->where('nome', 'like', '%' . str_replace(' ', '%', $busca) . '%');

        $result = $this->orderBy('nome')->all();

        foreach ($result as &$pessoa) {
            $pessoa->contatos = $contatosModel->allBy('id_pessoa', $pessoa->id);
        }

        return $result;
    }

    /**
     * Retorna uma única pessoa e seus contatos.
     * @param int $id ID da pessoa a ser obtida.
     * @return object|null Retorna a instância da pessoa se encontrada, null caso contrário.
     */
    public function obter(int $id)
    {
        $contatosModel = new Contatos();
        $pessoa = $this->find($id);
        if (!$pessoa) return null;
        $pessoa->contatos = $contatosModel->allBy('id_pessoa', $pessoa->id);
        return $pessoa;
    }
}
