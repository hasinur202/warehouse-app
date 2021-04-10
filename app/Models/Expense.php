<?php

namespace App\Models;

use App\Models\Expense_head;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function expense_head()
    {
        return $this->belongsTo(Expense_head::class, 'expense_head_id');
    }


}
