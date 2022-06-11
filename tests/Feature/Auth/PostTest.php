<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_must_be_authenticated_to_create_post()
    {
        $response = $this->get('/admin/posts/create');

        $response->assertStatus(302);
    }
}
