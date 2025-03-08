<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'message', 'created_by', 'is_active'];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
