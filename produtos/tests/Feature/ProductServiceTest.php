<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    private ProductService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ProductService();
    }

    public function test_nao_cria_produto_com_preco_invalido(): void
    {
        $this->assertThrows(
            fn () => $this->service->create(['name' => 'Camisa', 'price' => 0]),
            InvalidArgumentException::class
        );

        $this->assertDatabaseCount('products', 0);
    }

    public function test_update_altera_nome_e_preco_do_produto(): void
    {
        $product = Product::factory()->create(['name' => 'Camisa', 'price' => 50]);

        $this->service->update($product, ['name' => 'Camisa Nova', 'price' => 80]);

        $product->refresh();

        $this->assertSame('Camisa Nova', $product->name);
        $this->assertEquals(80, $product->price);
    }

    public function test_update_nao_altera_produto_com_preco_invalido(): void
    {
        $product = Product::factory()->create(['name' => 'Camisa', 'price' => 50]);

        $this->assertThrows(
            fn () => $this->service->update($product, ['price' => -10]),
            InvalidArgumentException::class
        );

        $product->refresh();

        $this->assertEquals(50, $product->price);
    }
}