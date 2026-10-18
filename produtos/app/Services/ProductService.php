<?php

namespace App\Services;

use App\Models\Product;
use InvalidArgumentException;

class ProductService
{
    public function create(array $data): Product
    {
        $this->validatePrice($data['price']);

        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        if (array_key_exists('price', $data)) {
            $this->validatePrice($data['price']);
        }

        $product->update($data);

        return $product;
    }

    private function validatePrice(float|int|string $price): void
    {
        if ($price <= 0) {
            throw new InvalidArgumentException('O preço deve ser maior que zero.');
        }
    }
}