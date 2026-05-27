<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['user_id', 'date', 'start_time', 'end_time', 'is_booked'])]
class AvailabilitySlot extends Model
{
    /** @use HasFactory<\Database\Factories\AvailabilitySlotFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_booked' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function testDrive(): HasOne
    {
        return $this->hasOne(TestDrive::class);
    }
}
