<?php

namespace App\Models\PersonalAccessToken;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;
    
    const ACTIVE   = 1;
    const INACTIVE = 0;
    
    protected $table = 'personal_access_tokens';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
