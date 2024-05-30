<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetails extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_code' ,
            'md_name',
            'md_email',
            'md_connect',
            'md_phone' ,
            'principle_name' ,
            'principle_email',
            'principle_phone',
            'principle_connect',

            'finance_name',
            'finance_email',
            'finance_phone',
            'finance_connect'];
}
