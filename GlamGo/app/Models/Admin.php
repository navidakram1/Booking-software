<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'role',
        'permissions',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array',
        'is_active' => 'boolean',
    ];

    // Define available roles and their hierarchy
    public static $roles = [
        'super_admin' => ['level' => 3, 'name' => 'Super Admin'],
        'admin' => ['level' => 2, 'name' => 'Administrator'],
        'manager' => ['level' => 1, 'name' => 'Manager'],
    ];

    // Define permissions for each module
    public static $modulePermissions = [
        'bookings' => ['view', 'create', 'edit', 'delete'],
        'services' => ['view', 'create', 'edit', 'delete'],
        'staff' => ['view', 'create', 'edit', 'delete'],
        'customers' => ['view', 'create', 'edit', 'delete'],
        'marketing' => ['view', 'create', 'edit', 'delete'],
        'content' => ['view', 'create', 'edit', 'delete'],
        'analytics' => ['view'],
        'settings' => ['view', 'edit'],
    ];

    /**
     * Check if the admin has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if the admin has permission for an action
     */
    public function hasPermission($module, $action)
    {
        // Implement your permission logic here
        return true; // For now, allow all permissions
    }

    /**
     * Check if admin has access to a module
     */
    public function hasModuleAccess($module)
    {
        // Implement your module access logic here
        return true; // For now, allow all access
    }

    /**
     * Get the role level
     */
    public function getRoleLevel(): int
    {
        return self::$roles[$this->role]['level'] ?? 0;
    }

    /**
     * Get the avatar URL attribute.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return Storage::url('avatars/' . $this->avatar);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Update last login information.
     *
     * @param string $ip
     * @return void
     */
    public function updateLastLogin($ip)
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => $ip
        ]);
    }
} 