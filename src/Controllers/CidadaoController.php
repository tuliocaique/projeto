<?php

namespace App\Controllers;

use App\Models\Cidadao;
use Projeto\Flash;
use Projeto\Request;

class CidadaoController extends AppController
{

    public function cadastrar(Request $request)
    {
        if ($request->isPost()) {

            if ($request->getData('nome')) {
                /** @var Cidadao $cidadao */
                $cidadao = Cidadao::newEntity();
                $cidadao->nome = $request->getData('nome');
                $cidadao->nis = time();
                $cidadao->save();
                return $request->redirectWith('success', 'Cidadão cadastrado com sucesso!', 'cadastrar');
            }
        }

        return $this->view('cidadao/cadastrar');
    }

    public function listar()
    {
        return $this->view('cidadao/listar', ['cidadaos' => Cidadao::all()]);
    }

    public function deletar(Request $request, $id)
    {
        /** @var Cidadao $cidadao */
        $cidadao = Cidadao::get($id);
        if ($cidadao->delete()) {
            return $request->redirectWith('success', 'Cidadão excluído com sucesso!', 'listar');
        } else {
            return $request->redirectWith('error', 'Erro ao excluir cidadão!', 'listar');
        }
    }

    public function buscar(Request $request)
    {
        $nis = $request->getQueryParams('nis');
        if ($nis) {
            /** @var Cidadao $cidadao */
            $cidadao = Cidadao::first('nis=:nis', [':nis' => $nis]);
            return $this->view('cidadao/buscar', ['cidadao' => $cidadao, 'busca' => $nis]);
        }

        Flash::flash('error', 'Nenhum NIS informado!');
        return $this->view('cidadao/buscar', ['busca' => $nis]);
    }
}