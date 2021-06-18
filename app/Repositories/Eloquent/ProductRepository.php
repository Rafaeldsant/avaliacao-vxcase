<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function findAll()
    {
        return $this->product->all();
    }

    public function findByProductName($productName) {

        if(isset($productName))
            $query = strtoupper($productName);

        return $this->product->where('name','LIKE','%'.$query.'%')
            ->orWhere('reference','LIKE','%'.$query.'%')
            ->get();

    }

    public function create(array $data) {
        return $this->product->create($data);
    }

    public function findById($id) {
        return $this->product->find($id);
    }

    public function update(array $data, $id) {
        return $this->product->find($id)->update($data);
    }

    public function destroy($id) {
        return $this->product->find($id)->delete();
    }
}