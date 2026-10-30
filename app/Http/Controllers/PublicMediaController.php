<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PublicMediaController extends Controller
{
    private const MIME_TYPES = [
        'aac' => 'audio/aac',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'm4a' => 'audio/mp4',
        'mp2' => 'audio/mpeg',
        'mp3' => 'audio/mpeg',
        'mp4' => 'audio/mp4',
        'mpa' => 'audio/mpeg',
        'mpga' => 'audio/mpeg',
        'mpeg' => 'audio/mpeg',
        'oga' => 'audio/ogg',
        'ogg' => 'audio/ogg',
        'pdf' => 'application/pdf',
        'png' => 'image/png',
        'wav' => 'audio/wav',
        'wave' => 'audio/wav',
        'webp' => 'image/webp',
    ];

    public function show(string $path)
    {
        $path = str_replace('\\', '/', $path);
        $segments = explode('/', $path);
        $allowedDirectories = ['audio', 'docs', 'gallery', 'mc', 'memories'];
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $contentType = self::MIME_TYPES[$extension] ?? null;

        if (in_array('', $segments, true)
            || in_array('.', $segments, true)
            || in_array('..', $segments, true)
            || ! in_array($segments[0] ?? '', $allowedDirectories, true)
            || ! preg_match('~^[A-Za-z0-9._/-]+$~', $path)
            || ! $contentType) {
            abort(404);
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => $contentType,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => str_starts_with($contentType, 'image/')
                ? 'public, max-age=31536000, immutable'
                : 'public, max-age=3600',
        ];

        if (config('filesystems.disks.public.driver') === 'local') {
            $file = $disk->path($path);

            if (! is_file($file)) {
                abort(404);
            }

            return response()->file($file, $headers);
        }

        return $disk->response($path, null, $headers);
    }
}
