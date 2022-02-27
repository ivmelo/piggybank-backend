<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory, CreatedUpdatedBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'birthdate', 'version', 'notes'];

    /**
     * The experiment of this participant.
     */
    public function experiment()
    {
        return $this->belongsTo(Experiment::class);
    }

    /**
     * The author of this participant.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The last person who edited this participant.
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Generates a token to be used when calling the API.
     */
    public function generateToken() {
        $this->token = md5(time() . $this->participant_code);
    }
}
