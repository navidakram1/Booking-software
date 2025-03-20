namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        // Apply filters
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            $query->whereBetween('price', [$min, $max]);
        }

        if ($request->has('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Apply search
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        // Eager load relationships
        $query->with(['specialists' => function ($q) {
            $q->select('id', 'name', 'image_url', 'rating')
              ->where('is_active', true);
        }]);

        // Apply sorting
        $sortField = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $services = $query->paginate(12);
        $categories = Category::all();

        return view('services.index', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        $service->load([
            'specialists' => function ($query) {
                $query->where('is_active', true)
                      ->select('id', 'name', 'image_url', 'rating', 'specialization');
            },
            'reviews' => function ($query) {
                $query->latest()
                      ->take(5)
                      ->with('user:id,name,avatar');
            }
        ]);

        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }

    public function byCategory(Category $category)
    {
        $services = Service::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['specialists' => function ($query) {
                $query->where('is_active', true)
                      ->select('id', 'name', 'image_url', 'rating');
            }])
            ->paginate(12);

        return view('services.category', compact('category', 'services'));
    }
} 