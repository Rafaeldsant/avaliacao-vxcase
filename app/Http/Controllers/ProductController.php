<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\ProductRepository;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->product->findByProductName($request->product_name);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->product->create($request->validated());
            return Response()->json('Produto Cadastrado com sucesso!', 201);
        } catch (\Exception $e) {
            return response()->json('Erro ao salvar produto',400);
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
        return $this->product->findById($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $this->product->update($request->validated(), $id);
            return Response()->json('Produto atualizado com sucesso!', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao atualizar produto',400);
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
            $this->product->destroy($id);
            return Response()->json('Produto Excluido!', 200);
        } catch (\Exception $e) {
            return response()->json('Erro ao excluir produto',400);
        }
    }
}
