<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];
    protected static $types = ['youth', 'aspirant', 'junior', 'senior', 'elder'];

    public static function getMemberTypes()
    {
        return self::$types;
    }
}
