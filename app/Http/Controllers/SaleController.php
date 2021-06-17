<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Repositories\SaleRepository;

class SaleController extends Controller
{

    private $sale;

    public function __construct(SaleRepository $sale)
    {
        $this->sale = $sale;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->sale->paginate($request->per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        try {
            $this->sale->create($request->validated());
            return Response()->json(['message'=>'Venda Concluída com sucesso!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message'=>'Erro ao finalizar venda'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sale->findById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        try {
            $this->sale->update($request->validated(), $id);
            return Response()->json('Venda Alterada com sucesso!', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao alterar venda',400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->sale->destroy($id);
            return Response()->json('Venda Excluída com sucesso!', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao excluir venda',400);
        }
    }
}
