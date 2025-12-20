<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;


class ProcessUploadedAvatar implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $full_path_to_original, public string $new_original_path_name)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $image = Image::read(
            Storage::disk('public')->get($this->full_path_to_original)
        );

        $sizes = config('avatars.sizes');
        $jpg_compression = config('avatars.jpeg_compression');
        $variant_pattern = config('avatars.variant_pattern');
        $extension = config('avatars.avatar_type');

        foreach ($sizes as $size) {
            $variant = clone $image;

            $variant->scale($size['width']);

            $path = sprintf($variant_pattern, $size['width'], $size['height']);
            Storage::disk('public')->put($path . '/' . $this->new_original_path_name, $variant->encodeByExtension($extension, $jpg_compression));
        }
    }
}
