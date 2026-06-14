<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contacts';

    protected $fillable = ['full_name', 'email', 'phone', 'position', 'company_name', 'field_of_activity', 'subject', 'message', 'file', 'is_read', 'type'];
}
