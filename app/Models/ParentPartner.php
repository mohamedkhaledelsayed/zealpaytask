<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentPartner extends Model
{
    use HasFactory;
    protected $table ='parent_partner';
    protected $hidden = ['updated_at','created_at','parent_id'];
    protected $guarded= [];


}
