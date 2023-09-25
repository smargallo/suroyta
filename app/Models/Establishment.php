<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class Establishment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'location', 'destination_id'];
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function images()
    {
        return $this->hasMany(EstablishmentImage::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
