<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TourLocation extends Pivot
{
    use HasFactory;

    protected $table = 'tour_location';  // Pivot table name

    protected $fillable = [
        'tour_id',
        'location_id',
    ];

    // Optional: Add relationships if necessary (e.g., for convenience)
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}