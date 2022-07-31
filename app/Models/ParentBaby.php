<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
class ParentBaby extends Authenticatable
{
    use HasFactory,HasApiTokens;
    protected $table ='parents';
    protected $hidden = ['updated_at','created_at'];
    protected $guarded= [];

    public function babies()
    {
        return $this->hasMany(Baby::class);
    }
    public function partners()
    {
        return $this->belongsToMany(ParentBaby::class,ParentPartner::class,'parent_id','partner_id');
    }
}
