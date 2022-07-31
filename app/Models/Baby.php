<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baby extends Model
{
    use HasFactory;
    protected $hidden = ['updated_at','created_at'];

    protected $guarded= [];

    public function parents()
    {
        return $this->belongsTo(ParentBaby::class);
    }
}
