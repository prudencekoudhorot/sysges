<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsInventaires extends Model
{
    use HasFactory;
    protected $table = 'details_inventaires';
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

    public function getInventaire()
    {
        return $this->belongsTo(Inventaires::class,'inventaires_id');
    }

    public function getProduit()
    {
        return $this->belongsTo(Produits::class,'articles_id');
    }
}
