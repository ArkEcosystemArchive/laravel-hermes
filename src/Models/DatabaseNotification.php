<?php

namespace ARKEcosystem\Hermes\Models;

use ARKEcosystem\Fortify\Models\Concerns\HasLocalizedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class DatabaseNotification extends BaseNotification
{
    use HasFactory;
    use HasLocalizedTimestamps;

    abstract public function name(): string;

    abstract public function logo(): string;

    public function logoMedia(): ?Media
    {
        return null;
    }

    public function logoIdentifier(): ?string
    {
        return null;
    }
}
