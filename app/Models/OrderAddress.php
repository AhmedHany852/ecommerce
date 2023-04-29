<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    public function getNameAtttribute()
    {
        return $this->first_name . '' . $this->last_name;
    }
    public function getContryNameAtttribute()
    {
        return Countries::getName($this->country);
    }
}