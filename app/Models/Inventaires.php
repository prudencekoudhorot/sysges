<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaires extends Model
{
    use HasFactory;
    protected $table = 'inventaires';
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function getUserCreated()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function getUserUpdated()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function getInventorie()
    {
        return $this->belongsTo(User::class,'inventories_id');
    }
}
