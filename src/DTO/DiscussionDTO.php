<?php

declare(strict_types=1);

namespace CarroPublic\Discussion\DTO;

class DiscussionDTO
{
    /**
     * @var string|null
     */
    private $discussion;

    /**
     * @var array
     */
    private $taggedUserIds;

    /**
     * @var array
     */
    private $additionalData;

    public function __construct(
        ?string $discussion = null,
        array $taggedUserIds = [],
        array $additionalData = []
    ) {
        $this->discussion = $discussion;
        $this->taggedUserIds = $taggedUserIds;
        $this->additionalData = $additionalData;
    }

    /**
     * @return string|null
     */
    public function getDiscussion(): ?string
    {
        return $this->discussion;
    }

    /**
     * @return array
     */
    public function getTaggedUserIds(): array
    {
        return $this->taggedUserIds;
    }

    /**
     * @return array
     */
    public function getAdditionalData(): array
    {
        return $this->additionalData;
    }
}
