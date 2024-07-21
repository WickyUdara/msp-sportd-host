<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\University;
use App\Models\Sport;
use App\Models\Categoryt;
class Point extends Model
{
    use HasFactory;
    protected $primaryKey = 'point_id';

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
