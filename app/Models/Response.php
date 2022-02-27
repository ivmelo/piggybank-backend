<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * The particpant who submitted this response.
     */
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    /**
     * The field to which this reponse applies.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
