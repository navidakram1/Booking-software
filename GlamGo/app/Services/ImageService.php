namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageService
{
    public function optimizeAndStore($image, $path, $sizes = ['sm' => 300, 'md' => 600, 'lg' => 1200])
    {
        $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
        $urls = [];

        foreach ($sizes as $size => $width) {
            $img = Image::make($image);
            
            // Resize image maintaining aspect ratio
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Optimize image quality
            $img->encode($image->getClientOriginalExtension(), 80);

            // Store image
            $sizePath = $path . '/' . $size . '_' . $filename;
            Storage::put('public/' . $sizePath, $img->stream());
            
            $urls[$size] = Storage::url($sizePath);
        }

        // Store original image
        $originalPath = $path . '/original_' . $filename;
        Storage::put('public/' . $originalPath, Image::make($image)->encode($image->getClientOriginalExtension(), 90)->stream());
        $urls['original'] = Storage::url($originalPath);

        return $urls;
    }

    public function generateThumbnail($image, $width = 150, $height = 150)
    {
        $img = Image::make($image);
        
        // Create thumbnail
        $img->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        });

        // Optimize thumbnail
        $img->encode($image->getClientOriginalExtension(), 70);

        $filename = 'thumb_' . Str::random(40) . '.' . $image->getClientOriginalExtension();
        $path = 'thumbnails/' . $filename;

        Storage::put('public/' . $path, $img->stream());

        return Storage::url($path);
    }

    public function deleteImages($urls)
    {
        foreach ($urls as $url) {
            $path = str_replace('/storage/', '', parse_url($url, PHP_URL_PATH));
            Storage::delete('public/' . $path);
        }
    }

    public function optimizeExisting($directory)
    {
        $files = Storage::files('public/' . $directory);
        
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
                $image = Image::make(Storage::get($file));
                
                // Optimize image
                $image->encode(pathinfo($file, PATHINFO_EXTENSION), 80);
                
                // Save optimized version
                Storage::put($file, $image->stream());
            }
        }
    }
} 