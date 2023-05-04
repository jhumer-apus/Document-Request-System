<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportingDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',
        'path',
        'type',
    ];

    protected $table = 'supporting_documents';
}
