<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'document_id',
    ];

    protected $table = 'request_documents';
}
