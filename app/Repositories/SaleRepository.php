<?php

namespace App\Repositories;

use App\Models\Sale;
use Carbon\Carbon;

class SaleRepository
{
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function paginate($pages)
    {
        return $this->sale->with('products:name,delivery_days')->paginate($pages);
    }

    public function create(array $data) {

        $data['purchase_at'] = Carbon::parse($data['purchase_at']);

        $sale = $this->sale->create($data);
        $sale->products()->sync($data['products']);

        return $sale;
    }

    public function findById($id) {
        return $this->sale->find($id);
    }

    public function update(array $data, $id) {

        $sale = $this->sale->find($id);

        $data['purchase_at'] = Carbon::parse($data['purchase_at']);
        $sale->update($data);

        $sale->products()->sync($data['products']);

        return $sale;
    }

    public function destroy($id) {

        $sale = $this->sale->find($id);
        $sale->products()->detach();

        return $sale->delete();
    }
}