<?php

namespace CarroPublic\Discussion\Traits;

use Illuminate\Database\Eloquent\Model;
use CarroPublic\Discussion\Contracts\DirectDiscussable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDiscussion
{
    public function discussions()
    {
        return $this->morphMany(config('discussion.discussion_class'), 'discussable');
    }

    public function discussion(string $discussion, array $taggedUserIds = [])
    {
        return $this->discussAsUser(auth()->user(), $discussion);
    }

    public function discussAsUser(?Model $user, string $discussion, array $taggedUserIds = [])
    {
        $discussableClass = config('discussion.discussion_class');

        $discussionTopic = new $discussableClass([
            'discussion' => $discussion,
            'is_approved' => ($user instanceof DirectDiscussable) ? ! $user->discussionNeedApproval($this) : true,
            'user_id' => is_null($user) ? null : $user->getKey(),
            'commentable_id' => $this->getKey(),
            'commentable_type' => get_class(),
            'tagged_user_id' => !empty($taggedUserIds) ? json_encode($taggedUserIds) : null,
        ]);

        return $this->discussions()->save($discussionTopic);
    }
}
