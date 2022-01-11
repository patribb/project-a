<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attendee_id',
        'event_id',
        'path',
        'reviewed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attendee_id' => 'integer',
        'event_id' => 'integer',
        'reviewed' => 'boolean',
    ];

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
