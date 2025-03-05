<?php

namespace Tests\Unit\Middleware;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use PHPUnit\Framework\Attributes\Test;

class AdminMiddlewareTest extends TestCase
{
    protected $middleware;
    protected $request;
    protected $next;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->middleware = new AdminMiddleware();
        $this->request = Request::create('/admin/dashboard', 'GET');
        $this->next = function () {
            return response('OK');
        };
    }

    #[Test]
    public function it_allows_authenticated_admin_users()
    {
        // Create and login as admin user
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);
        
        // Set admin session
        Session::put('admin_session', true);

        $response = $this->middleware->handle($this->request, $this->next);

        $this->assertEquals('OK', $response->getContent());
    }

    #[Test]
    public function it_redirects_unauthenticated_users()
    {
        $response = $this->middleware->handle($this->request, $this->next);

        $this->assertTrue($response->isRedirect(route('admin.login')));
        $this->assertEquals('Please login to access admin area', 
            session('error'));
    }

    #[Test]
    public function it_redirects_non_admin_users()
    {
        // Create and login as non-admin user
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->middleware->handle($this->request, $this->next);

        $this->assertTrue($response->isRedirect(route('home')));
        $this->assertEquals('Unauthorized access to admin area', 
            session('error'));
    }

    #[Test]
    public function it_handles_expired_sessions()
    {
        // Create and login as admin user but don't set session
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $response = $this->middleware->handle($this->request, $this->next);

        $this->assertTrue($response->isRedirect(route('admin.login')));
        $this->assertEquals('Your session has expired. Please login again', 
            session('error'));
    }

    #[Test]
    public function it_implements_rate_limiting()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);
        Session::put('admin_session', true);

        // Simulate multiple requests
        $key = 'admin_attempts_' . $this->request->ip();
        Cache::put($key, 6, 60); // Set attempts above limit

        $response = $this->middleware->handle($this->request, $this->next);

        $this->assertEquals(429, $response->getStatusCode()); // Too Many Requests
        $this->assertJson($response->getContent());
        $this->assertStringContainsString('Too many attempts', 
            $response->getContent());
    }

    #[Test]
    public function it_logs_unauthorized_access_attempts()
    {
        Log::shouldReceive('warning')
            ->once()
            ->with('Unauthenticated admin access attempt', \Mockery::type('array'))
            ->andReturnNull();

        $request = Request::create('/admin/dashboard', 'GET');
        $request->setUserResolver(function () {
            return null;
        });

        $response = $this->middleware->handle($request, function () {});
        
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('admin.login'), $response->getTargetUrl());
    }

    #[Test]
    public function it_logs_successful_admin_access()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);
        Session::put('admin_session', true);

        Log::shouldReceive('info')
            ->once()
            ->with('Admin access granted', 
                \Mockery::type('array'))
            ->andReturnNull();

        $response = $this->middleware->handle($this->request, $this->next);
        
        $this->assertEquals('OK', $response->getContent());
        $this->assertTrue(session()->has('admin_session'));
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
} 