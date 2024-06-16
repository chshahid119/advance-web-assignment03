<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table1 extends Model
{
    protected $table = 'table_1';
    protected $fillable = ['column1', 'column2', 'column3'];
}
