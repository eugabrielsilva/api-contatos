<?php

namespace Glowie\Controllers;

use Glowie\Core\Http\Controller;

class Front extends Controller
{

    /**
     * Página inicial.
     */
    public function index()
    {
        $this->renderLayout('template', 'index');
    }

    /**
     * Visualização de contatos.
     */
    public function visualizar()
    {
        $this->renderLayout('template', 'visualizar', [
            'id' => $this->params->id
        ]);
    }
}
