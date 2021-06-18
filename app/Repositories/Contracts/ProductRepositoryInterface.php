<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function findAll();

    public function findByProductName($productName);

    public function create(array $data);

    public function findById($id);

    public function update(array $data, $id);

    public function destroy($id);
}