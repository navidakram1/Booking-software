// ... existing code ...
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
// ... existing code ...