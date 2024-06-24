<?php

namespace App\Http\Controllers;

use App\Models\Imposto;
use Illuminate\Http\Request;

class ImpostoController extends Controller
{
    public function opcoesFormIcms() {
        return response()->json(Imposto::opcoesFormIcms());
    }

    public function opcoesFormIpi() {
        return response()->json(Imposto::opcoesFormIpi());
    }

    public function opcoesFormPis() {
        return response()->json(Imposto::opcoesFormPis());
    }

    public function opcoesFormCofins() {
        return response()->json(Imposto::opcoesFormCofins());
    }

    public function opcoesFormImportacao() {
        return response()->json(Imposto::opcoesFormImportacao());
    }

    public function opcoesFormExportacao() {
        return response()->json(Imposto::opcoesFormExportacao());
    }

    public function opcoesFormDetalhamento() {
        return response()->json(Imposto::opcoesFormDetalhamento());
    }

    public function opcoesFormsImpostos() {
        return response()->json([
            'icms' => Imposto::opcoesFormIcms(),
            'ipi' => Imposto::opcoesFormIpi(),
            'pis' => Imposto::opcoesFormPis(),
            'cofins' => Imposto::opcoesFormCofins(),
            // 'importacao' => Imposto::opcoesFormImportacao(),
            // 'exportacao' => Imposto::opcoesFormExportacao(),
            // 'detalhamento' => Imposto::opcoesFormDetalhamento(),
        ]);
    }
}
