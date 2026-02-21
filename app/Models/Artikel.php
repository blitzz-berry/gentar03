<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'konten',
        'thumbnail',
        'video_url',
        'video_file',
        'kategori',
        'aktif',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tanggal_publikasi' => 'datetime',
    ];

    public function getHasVideoAttribute(): bool
    {
        return !empty($this->video_file) || !empty($this->video_url);
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        $id = $this->extractYoutubeId($this->video_url);
        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }

    public function getVideoThumbnailUrlAttribute(): ?string
    {
        $id = $this->extractYoutubeId($this->video_url);
        return $id ? "https://img.youtube.com/vi/{$id}/hqdefault.jpg" : null;
    }

    public function getSafeKontenAttribute(): string
    {
        return self::sanitizeContent($this->konten ?? '');
    }

    public static function sanitizeContent(string $content): string
    {
        $allowedTags = '<p><br><strong><em><u><ol><ul><li><a><blockquote><h1><h2><h3><h4><h5><h6><code><pre><div>';
        $clean = strip_tags($content, $allowedTags);

        // Remove inline event handlers and javascript links.
        $clean = preg_replace('/on\w+\s*=\s*"[^"]*"/i', '', $clean) ?? $clean;
        $clean = preg_replace("/on\w+\s*=\s*'[^']*'/i", '', $clean) ?? $clean;
        $clean = preg_replace('/on\w+\s*=\s*[^\s>]+/i', '', $clean) ?? $clean;
        $clean = preg_replace('/href\s*=\s*"javascript:[^"]*"/i', 'href="#"', $clean) ?? $clean;
        $clean = preg_replace("/href\s*=\s*'javascript:[^']*'/i", "href='#'", $clean) ?? $clean;

        return $clean;
    }

    private function extractYoutubeId(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $parts = parse_url($url);
        if (!isset($parts['host'])) {
            return null;
        }

        $host = strtolower($parts['host']);

        if ($host === 'youtu.be') {
            return ltrim($parts['path'] ?? '', '/') ?: null;
        }

        if (str_contains($host, 'youtube.com')) {
            if (isset($parts['query'])) {
                parse_str($parts['query'], $query);
                if (!empty($query['v'])) {
                    return $query['v'];
                }
            }

            $path = $parts['path'] ?? '';
            if (str_starts_with($path, '/embed/')) {
                return substr($path, strlen('/embed/')) ?: null;
            }
            if (str_starts_with($path, '/shorts/')) {
                return substr($path, strlen('/shorts/')) ?: null;
            }
        }

        return null;
    }
}
