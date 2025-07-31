<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * テスト実行前のセットアップ
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 例外ハンドリングを無効化（Fortify の ValidationException が
        // 直接テストに届くようになります）
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function registration_form_can_be_displayed()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('会員登録');
    }


    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function registration_requires_all_fields()
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function registration_requires_unique_email()
    {
        User::factory()->create(['email' => 'dup@example.com']);

        $response = $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'dup@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_form_can_be_displayed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('ログイン');
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        User::factory()->create([
            'email'    => 'login@example.com',
            'password' => bcrypt('secret'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'login@example.com',
            'password' => 'secret',
        ]);

        // Fortify の 'home' 設定に合わせてリダイレクト
        $response->assertRedirect('/home');
        $this->assertAuthenticated();
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        $response = $this->from('/login')->post('/login', [
            'email'    => 'wrong@example.com',
            'password' => 'invalid',
        ]);

        // 認証失敗時は /login にリダイレクト
        $response->assertRedirect('/login');

        // sessions に errors があることをチェック
        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}