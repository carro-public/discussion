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
        'tagged_user_id',
        'read_user_id',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'tagged_user_id' => 'json',
        'read_user_id' => 'json',
    ];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeDisapproved($query)
    {
        return $query->where('is_approved', false);
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

    /**
     * Update the discussion as read by the user.
     *
     * @param int $userId
     *
     * @return $this
     */
    public function readByUserId($userId)
    {
        $readUserIds = $this->read_user_id ?? [];
        $readUserIds[] = $userId;

        $this->update([
            'read_user_id' => array_unique($readUserIds),
        ]);

        return $this;
    }

    /**
     * Check if the discussion is read by the user.
     *
     * @param int $userId
     *
     * @return bool
     */
    public function isReadByUserId($userId)
    {
        return in_array($userId, $this->read_user_id ?? []);
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
