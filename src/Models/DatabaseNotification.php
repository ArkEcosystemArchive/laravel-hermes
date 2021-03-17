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

    abstract public function logoMedia(): ?Media;

    abstract public function logoIdentifier(): ?string;
}
