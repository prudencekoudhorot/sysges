<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsSorties extends Model
{
    use HasFactory;
    protected $table = 'details_sorties';
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

    public function getProduit()
    {
        return $this->belongsTo(Produits::class,'articles_id');
    }

    public function getSortie()
    {
        return $this->belongsTo(SortiesProduits::class,'sorties_produits');
    }
}
