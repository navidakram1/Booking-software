# Common Issues and Resolutions

## Recent Issues Resolved

### Artisan File Location Issue (March 5, 2024)
**Issue:** Unable to run artisan commands, error "Could not open input file: artisan"
**Resolution:** 
- Identified that the Laravel installation is in the `GlamGo` directory
- Confirmed working artisan file exists at `GlamGo/artisan`
- All Laravel commands should be run from within the `GlamGo` directory
- Extra artisan file in parent directory should be removed

**Correct Usage:**
```bash
cd GlamGo
php artisan <command>
```

**Common Mistakes to Avoid:**
- Don't run artisan commands from the parent directory
- Ensure you're in the `GlamGo` directory before running commands
- Don't create duplicate artisan files in other locations 

### Admin Middleware Error Handling (March 5, 2024)
**Issue:** Admin middleware lacks proper error handling and user feedback

**Current Problems:**
1. Silent failures in authentication
2. No proper redirect on unauthorized access
3. Missing proper session handling
4. Lack of detailed error logging
5. No custom error messages for different scenarios

**Required Improvements:**
1. Authentication Error Handling
   ```php
   if (!auth()->check()) {
       return redirect()->route('admin.login')
           ->with('error', 'Please login to access admin area');
   }
   ```

2. Role Verification
   ```php
   if (!auth()->user()->isAdmin()) {
       return redirect()->route('home')
           ->with('error', 'Unauthorized access: Admin privileges required');
   }
   ```

3. Session Handling
   ```php
   if (!session()->has('admin_session')) {
       return redirect()->route('admin.login')
           ->with('error', 'Admin session expired. Please login again');
   }
   ```

4. Error Logging
   ```php
   Log::error('Admin access denied', [
       'user' => auth()->user()->id ?? 'guest',
       'ip' => request()->ip(),
       'url' => request()->fullUrl()
   ]);
   ```

**Implementation Checklist:**
- [ ] Add try-catch blocks for error handling
- [ ] Implement proper authentication checks
- [ ] Add session validation
- [ ] Include detailed error logging
- [ ] Create custom error messages
- [ ] Add redirect paths for different scenarios
- [ ] Implement rate limiting for failed attempts
- [ ] Add audit logging for security events

**Best Practices:**
1. Always validate admin privileges before processing
2. Provide clear error messages to users
3. Log all authentication failures
4. Implement rate limiting for security
5. Use proper HTTP status codes
6. Maintain audit logs for security events
7. Handle session timeouts gracefully

**Example Implementation:**
```php
public function handle($request, Closure $next)
{
    try {
        // Check if user is authenticated
        if (!auth()->check()) {
            throw new AuthenticationException('Please login to continue');
        }

        // Verify admin role
        if (!auth()->user()->isAdmin()) {
            throw new AuthorizationException('Unauthorized access');
        }

        // Validate session
        if (!session()->has('admin_session')) {
            throw new AuthenticationException('Session expired');
        }

        return $next($request);

    } catch (AuthenticationException $e) {
        Log::warning('Admin authentication failed', [
            'ip' => request()->ip(),
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('admin.login')
            ->with('error', $e->getMessage());

    } catch (AuthorizationException $e) {
        Log::error('Unauthorized admin access attempt', [
            'user' => auth()->user()->id,
            'ip' => request()->ip()
        ]);

        return redirect()->route('home')
            ->with('error', 'Unauthorized access');

    } catch (Exception $e) {
        Log::error('Admin middleware error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->route('home')
            ->with('error', 'An unexpected error occurred');
    }
}
```

**Testing Scenarios:**
1. Unauthenticated access attempts
2. Non-admin user access attempts
3. Expired session handling
4. Multiple failed login attempts
5. Invalid session data
6. Server-side validation bypass attempts 