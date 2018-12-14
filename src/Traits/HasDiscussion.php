<?php

namespace CarroPublic\Discussion\Traits;

use Illuminate\Database\Eloquent\Model;
use CarroPublic\Discussion\Contracts\DirectDiscussable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDiscussion
{
    public function discussions()
    {
        return $this->morphMany(config('discussion.disucssion_class'), 'discussable');
    }

    public function disucssion(string $disucssion)
    {
        return $this->discussAsUser(auth()->user(), $disucssion);
    }

    public function discussAsUser(?Model $user, string $disucssion)
    {
        $discussableClass = config('discussion.disucssion_class');

        $discussionTopic = new $discussableClass([
            'discussions' => $disucssion,
            'is_approved' => ($user instanceof DirectDiscussable) ? ! $user->discussionNeedApproval($this) : false,
            'user_id' => is_null($user) ? null : $user->getKey(),
            'commentable_id' => $this->getKey(),
            'commentable_type' => get_class(),
        ]);

        return $this->discussions()->save($discussionTopic);
    }
}
