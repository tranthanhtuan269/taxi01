<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    public const STATUSES = [
        'new' => 'Chưa gọi',
        'called' => 'Đã gọi',
        'closed' => 'Đã xong',
    ];

    protected $fillable = ['phone', 'note', 'contact_channel', 'status'];

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
