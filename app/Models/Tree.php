<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    /**
     * @var mixed|null
     */
    public mixed $parent_id;
    public mixed $name;

    protected $table = 'tree';
    protected $fillable = ['id', 'parent_id', 'name', 'order'];

}
