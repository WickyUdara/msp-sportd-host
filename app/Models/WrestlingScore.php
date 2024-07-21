<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrestlingScore extends Model
{
    use HasFactory;

    protected $table = 'wrestling_scores';
    protected $primaryKey = 'score_id';

    protected $fillable = [
        'event_id',
        'university_id',
        'score',
        'period',
    ];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id', 'uni_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
