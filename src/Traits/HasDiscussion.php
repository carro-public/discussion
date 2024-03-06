<?php

namespace CarroPublic\Discussion\Traits;

use Illuminate\Database\Eloquent\Model;
use CarroPublic\Discussion\DTO\DiscussionDTO;
use CarroPublic\Discussion\Contracts\DirectDiscussable;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDiscussion
{
    public function discussions()
    {
        return $this->morphMany(config('discussion.discussion_class'), 'discussable');
    }

    public function discussion(string $discussion, ?DiscussionDTO $discussionDTO = null)
    {
        return $this->discussAsUser(auth()->user(), $discussion, $discussionDTO);
    }

    public function discussAsUser(?Model $user, string $discussion, ?DiscussionDTO $discussionDTO = null)
    {
        $discussableClass = config('discussion.discussion_class');
        $data = [
            'discussion' => $discussion,
            'is_approved' => ($user instanceof DirectDiscussable) ? ! $user->discussionNeedApproval($this) : true,
            'user_id' => is_null($user) ? null : $user->getKey(),
            'commentable_id' => $this->getKey(),
            'commentable_type' => get_class(),
            'read_user_id' => is_null($user) ? null : json_encode([$user->getKey()]),
        ];

        if ($discussionDTO) {
            if (!empty($discussionDTO->getTaggedUserIds())) {
                $data = array_merge($data, [
                    'tagged_user_id' => json_encode($discussionDTO->getTaggedUserIds()),
                ]);
            }

            if (!empty($discussionDTO->getAdditionalData())) {
                $data = array_merge($data, [
                    'additional_data' => $discussionDTO->getAdditionalData(),
                ]);
            }
        }

        $discussionTopic = new $discussableClass($data);

        return $this->discussions()->save($discussionTopic);
    }
}
