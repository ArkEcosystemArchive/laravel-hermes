<?php

declare(strict_types=1);

namespace ARKEcosystem\Hermes\Contracts;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

interface HasNotificationLogo
{
    public function logo(): ?Media;

    public function fallbackIdentifier(): ?string;
}
