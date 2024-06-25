<?php

// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Define fillable fields if needed
    protected $fillable = ['user_id', 'deskripsi', 'jumlah'];

    // Define relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
