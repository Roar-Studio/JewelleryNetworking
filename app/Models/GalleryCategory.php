<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_categories';

    protected $fillable = [
        'name',
        'is_active',
        'is_deleted',
    ];

    // Relationship: One Category has Many Galleries
    public function media_files()
    {
        return $this->hasMany(Gallery::class, 'gallery_category_id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Gallery::class, 'gallery_category_id')->orderBy('id');
    }

    public function videos()
    {
        return $this->hasMany(Videos::class, 'gallery_category_id');
    }
}
