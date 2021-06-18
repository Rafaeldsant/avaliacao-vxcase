<?php

namespace App\Repositories\Contracts;

interface SaleRepositoryInterface
{
    public function paginate($pages);

    public function create(array $data);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);
}