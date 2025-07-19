<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_login_page_renders()
    {
        $this->withoutMiddleware();
        
        $response = $this->get('admin/login');

        $response->assertSee('Login');

    }

    
    public function test_admin_login_fails_with_invalid_email_format()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminGuestMiddleware::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
        
        $response = $this->from('/admin/login')->post('/admin/auth', [
            'email' => 'not-an-email',
            'password' => 'Welc0me!1225',
        ]);

        // Should redirect back to the form
        $response->assertRedirect('/admin/login');

        // Assert validation error for 'email'
        $response->assertSessionHasErrors(['email']);

        // Ensure no user is authenticated on the 'admin' guard
        $this->assertGuest('admin');
    }

    
    public function test_admin_login_fails_with_invalid_password_format()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminGuestMiddleware::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
        
        $response = $this->from('/admin/login')->post('/admin/auth', [
            'email' => 'shadow902@gmail.com',
            'password' => 'Welc0me!',
        ]);

        // Should redirect back to the form
        $response->assertRedirect('/admin/login');

        // Assert validation error for 'email'
        $response->assertSessionHasErrors(['email']);

        // Ensure no user is authenticated on the 'admin' guard
        $this->assertGuest('admin');
    }


    
    public function test_user_can_login_with_valid_credentials()
    {
        $this->withoutMiddleware([
            \App\Http\Middleware\AdminGuestMiddleware::class,
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
        
        // Create a user with known credentials
        $admin = Admin::factory()->create([
            'email' => 'shadow902@gmail.com',
            'password' => bcrypt('Welc0me!1225'),
        ]);

        // Simulate login request
        $response = $this->post('admin/auth', [
            'email' => 'shadow902@gmail.com',
            'password' => 'Welc0me!1225',
        ]);

        // Assert the user was authenticated and redirected
        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect(route('admin.index')); // Or your dashboard route
    } 
}
