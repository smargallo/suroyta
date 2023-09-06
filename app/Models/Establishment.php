<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;

class Establishment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'location'];
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
