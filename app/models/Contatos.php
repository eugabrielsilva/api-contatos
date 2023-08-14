<?php

namespace Glowie\Models;

use Glowie\Core\Database\Model;

class Contatos extends Model
{
    protected $_timestamps = true;
    protected $_fields = ['id', 'id_pessoa', 'contato', 'tipo'];
    protected $_updatable = ['id', 'id_pessoa', 'contato', 'tipo'];
}
