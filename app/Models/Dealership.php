<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'code', 'address', 'contacts', 'availability_enabled'])]
class Dealership extends Model
{
    /** @use HasFactory<\Database\Factories\DealershipFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'contacts' => 'array',
            'availability_enabled' => 'boolean',
        ];
    }
}
