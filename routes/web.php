use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Service Routes
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/{service}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/category/{category}', [ServiceController::class, 'byCategory'])->name('services.category');
});

// Specialist Routes
Route::prefix('specialists')->group(function () {
    Route::get('/', [SpecialistController::class, 'index'])->name('specialists.index');
    Route::get('/{specialist}', [SpecialistController::class, 'show'])->name('specialists.show');
});

// Gallery Routes
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery');
    Route::post('/load-more', [GalleryController::class, 'loadMore'])->name('gallery.load-more');
});

// Static Pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Newsletter Subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Authentication Routes
require __DIR__.'/auth.php'; 