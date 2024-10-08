<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    public int $id;
    public int $age;
    public int $memberTypeId;
    public float $amount;
    public int $fiscalYear;
}
