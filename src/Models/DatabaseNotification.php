<?php

namespace ARKEcosystem\Hermes\Models;

use ARKEcosystem\Fortify\Models\Concerns\HasLocalizedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;

abstract class DatabaseNotification extends BaseNotification
{
    use HasFactory;
    use HasLocalizedTimestamps;

    abstract public function name(): string;

    abstract public function logo(): string;
}
