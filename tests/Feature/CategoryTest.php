<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     */
    public function category_index_works()
    {
        Category::factory()->count(13)->create();

        $response = $this->get(route('category.index'));
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function category_index_page2_works()
    {
        Category::factory()->count(13)->create();

        $response = $this->get(route('category.index') . '?page=2');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    /**
     * @test
     */
    public function category_show_works()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('category.show', $category->id));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $category->name,
            'description' => $category->description,
        ]);
    }

    /**
     * @test
     */
    public function category_store_works()
    {
        $category = Category::factory()->make();

        $this->assertEquals(0, Category::count());

        $response = $this->post(route('category.store'), [
            'name' => $category->name,
        ]);
        $response->assertStatus(201);

        $this->assertEquals(1, Category::count());
    }

    /**
     * @test
     */
    public function category_update_works()
    {
        $category = Category::factory()->create();

        $response = $this->put(route('category.update', $category->id), [
            'name' => $category->name . '111',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $category->name . '111',
            'description' => $category->description,
        ]);
    }

    /**
     * @test
     */
    public function category_destroy_works()
    {
        $category = Category::factory()->create();

        $this->assertEquals(1, Category::count());

        $response = $this->delete(route('category.destroy', $category->id));
        $response->assertStatus(200);

        $this->assertEquals(0, Category::count());
    }
}
