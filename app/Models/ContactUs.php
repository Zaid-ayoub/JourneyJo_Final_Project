<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_us';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'contact_id'; // Set the primary key to 'contact_id'

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_email',
        'message',
        'add_to_testimonial', // Don't forget to add this field if you're using it
    ];

    /**
     * Get the user who submitted the contact message.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}