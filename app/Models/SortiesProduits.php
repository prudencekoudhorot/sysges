<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortiesProduits extends Model
{
    use HasFactory;
    protected $table = 'sorties_produits';
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

    public function getDemandeur()
    {
        return $this->belongsTo(User::class,'demandeurs_id');
    }
}
