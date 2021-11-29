<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedBook extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'issued_by');
    }
}
