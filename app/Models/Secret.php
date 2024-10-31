<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'max_views', 'expires_at'];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = encrypt($value);
    }

    public function getContentPasswordAttribute(): string
    {
        return decrypt($this->content);
    }
}
