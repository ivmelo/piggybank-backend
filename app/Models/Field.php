<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Field extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'type'];

    /**
     * The experiment this field belongs to.
     */
    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }

    /**
     * The experiment this field belongs to.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The experiment this field belongs to.
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
