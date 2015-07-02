<?php

namespace DraperStudio\Messageable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message.
 */
class Message extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var array
     */
    protected $touches = ['thread'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo($this->creator_type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany(Participant::class, 'thread_id', 'thread_id');
    }

    /**
     * @return mixed
     */
    public function recipients()
    {
        return $this->participants()
                    ->where('participant_id', '!=', $this->participant_id)
                    ->where('participant_type', '!=', $this->participant_type);
    }
}
