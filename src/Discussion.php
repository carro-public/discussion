<?php

namespace CarroPublic\Discussion;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	protected $fillable = [
		'discussion',
		'user_id',
		'is_approved'
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