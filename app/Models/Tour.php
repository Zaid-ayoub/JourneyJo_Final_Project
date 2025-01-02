<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $primaryKey = 'tour_id';
    protected $fillable = [
        'name', 'price', 'description', 'start_date', 'end_date', 
        'available_seats', 'category_id', 'company_id', 'cover_image'
    ];

    // Define the relationship with the User model
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Define the relationship with the TourImage model
    // In Tour model (Tour.php)

public function images()
{
    return $this->hasMany(TourImage::class, 'tour_id', 'tour_id');
}

// app/Models/Tour.php

public function locations()
{
    return $this->belongsToMany(Location::class, 'tour_location', 'tour_id', 'location_id')
                ->using(TourLocation::class); // Specify the pivot model
}

public function bookings()
{
    return $this->hasMany(Booking::class, 'tour_id', 'tour_id');
}



}