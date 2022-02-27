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
     * The author of this field.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The responses that this field has received.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    /**
     * The last person who edited this field.
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
