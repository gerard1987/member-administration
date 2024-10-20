<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalYear extends Model
{
    use HasFactory;

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'fiscal_year');
    }
}
