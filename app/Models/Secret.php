<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'max_views', 'expires_at', 'token'];

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'content' => 'encrypted'
        ];
    }

}
