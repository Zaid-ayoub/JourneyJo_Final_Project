<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTour extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_tours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'location_input', 'start_date', 'end_date', 'number_of_people', 'budget', 
        'special_requirements', 'transportation_preference', 'status', 'company_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user who created the custom tour.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company associated with the custom tour.
     */
    public function company()
    {
        return $this->belongsTo(User::class);
    }
}