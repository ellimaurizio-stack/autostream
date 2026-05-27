<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['customer_id', 'vehicle_model_id', 'availability_slot_id', 'date', 'scheduled_time', 'status', 'reservation_code'])]
class TestDrive extends Model
{
    /** @use HasFactory<\Database\Factories\TestDriveFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicleModel(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function availabilitySlot(): BelongsTo
    {
        return $this->belongsTo(AvailabilitySlot::class);
    }

    public function survey(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Survey::class);
    }
}
