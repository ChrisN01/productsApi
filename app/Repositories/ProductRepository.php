<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function paginateProducts(int $perPage = 10)
    {
        return Product::paginate($perPage);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
