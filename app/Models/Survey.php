<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['test_drive_id', 'driving_rating', 'comfort_rating', 'positive_feedback', 'negative_feedback', 'privacy_consent'])]
class Survey extends Model
{
    /** @use HasFactory<\Database\Factories\SurveyFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'driving_rating' => 'integer',
            'comfort_rating' => 'integer',
            'privacy_consent' => 'boolean',
        ];
    }

    public function testDrive(): BelongsTo
    {
        return $this->belongsTo(TestDrive::class);
    }
}
