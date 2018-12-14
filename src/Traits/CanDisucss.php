<?php

namespace CarroPublic\Discussion\Traits;

trait CanDisucss
{
    public function discussionNeedApproval($model): bool
    {
        return false;
    }
}
