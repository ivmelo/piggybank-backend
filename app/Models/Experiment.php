<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;

class Experiment extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The fields of the experiment.
     */
    public function fields()
    {
        return $this->hasMany(Field::class)->orderBy('order');
    }

    /**
     * The participants of the experiment.
     */
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    /**
     * The author of this experiment.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The last person who edited this experiment.
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
