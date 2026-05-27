<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['customer_id', 'legal_document_id', 'ip_address', 'user_agent', 'consented_at'])]
class ConsentLog extends Model
{
    /** @use HasFactory<\Database\Factories\ConsentLogFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'consented_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function legalDocument(): BelongsTo
    {
        return $this->belongsTo(LegalDocument::class);
    }
}
