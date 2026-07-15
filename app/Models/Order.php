<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'web_services_id', 'invoice_number', 'total_amount', 'payment_status', 'project_status'])]
class Order extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function webService(): BelongsTo
    {
        return $this->belongsTo(WebService::class, 'web_services_id');
    }
}
