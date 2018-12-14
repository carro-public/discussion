<?php

namespace CarroPublic\Discussion;

use Exception;
use Illuminate\Database\Eloquent\Model;
use CarroPublic\Discussion\Traits\HasDiscussion;

class Discussion extends Model
{
    use HasDiscussion;

    protected $fillable = [
        'discussion',
        'is_approved',
        'user_id',
        'discussable_id',
        'discussable_type',
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function discussable()
    {
        return $this->morphTo();
    }

    public function discusser()
    {
        return $this->belongsTo($this->getAuthModelName(), 'user_id');
    }

    public function approve()
    {
        $this->update([
            'is_approved' => true,
        ]);

        return $this;
    }

    protected function getAuthModelName()
    {
        if (config('discussion.user_model')) {
            return config('discussion.user_model');
        }

        if (!is_null(config('auth.providers.users.model'))) {
            return config('auth.providers.users.model');
        }

        throw new Exception('Could not determine the discusser model name.');
    }
}
