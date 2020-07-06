<?php

namespace CarroPublic\Discussion\Traits;

trait CanDiscuss
{
    public function discussionNeedApproval($model): bool
    {
        return false;
    }
}
