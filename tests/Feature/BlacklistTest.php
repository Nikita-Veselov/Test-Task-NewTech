<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class BlacklistTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('main');
    }
    public function test_store()
    {
        $response = $this->post('add');
        $response->assertSessionHasErrors();
        $response->assertRedirect();
    }

    public function test_show()
    {
        $response = $this->post('show');
        $response->assertSessionHas('blacklists', '');
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
    }
}
