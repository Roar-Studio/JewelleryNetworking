<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_type',
        'gallery_category_id',
        'youtube_url',
        'is_active',
        'is_deleted',
    ];

    // Relationship: Each Videos belongs to a Category
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }
    
    // Helper method to get embed URL
    public function getEmbedUrlAttribute()
    {
        return $this->convertToEmbedUrl($this->youtube_url);
    }
    
    // Helper method to get thumbnail
    public function getThumbnailUrlAttribute()
    {
        $videoId = $this->getYoutubeVideoId($this->youtube_url);
        return $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
    }
    
    private function convertToEmbedUrl($url)
    {
        $videoId = $this->getYoutubeVideoId($url);
        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : $url;
    }
    
    private function getYoutubeVideoId($url)
    {
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        } elseif (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
