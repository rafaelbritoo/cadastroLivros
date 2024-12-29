<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\RelatorioRequest;
use App\Services\RelatorioService;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService)
    {
        $this->relatorioService = $relatorioService;
    }

    public function index(RelatorioRequest $request)
    {
        $livros = $this->relatorioService->getLivros($request);

        return response()->json($livros);
    }
}
