namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'discount_type',
        'discount_value',
        'valid_until',
        'is_active'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'valid_until',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'offer_services');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('valid_until', '>', now());
    }

    public function getFormattedDiscountAttribute()
    {
        return $this->discount_type === 'percentage' 
            ? "{$this->discount_value}%" 
            : "$" . number_format($this->discount_value, 2);
    }
} 