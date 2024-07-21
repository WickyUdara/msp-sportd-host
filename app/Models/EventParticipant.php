<?php

namespace App\Models;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'uni_id'];

    public function university() {
        return $this->belongsTo(University::class, 'uni_id');
    }
}
