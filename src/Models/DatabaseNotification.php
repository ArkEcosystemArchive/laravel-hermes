<?php

namespace ARKEcosystem\Hermes\Models;

use ARKEcosystem\Fortify\Models\Concerns\HasLocalizedTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;
use Illuminate\Support\Arr;

/**
 * @property string $relatable_type
 * @property int $relatable_id
 */
abstract class DatabaseNotification extends BaseNotification
{
    use HasFactory;
    use HasLocalizedTimestamps;

    /**
     * Register any events for your application.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function (DatabaseNotification $notification) {
            $data = Arr::get($notification, 'data');
            $notification->relatable_id = Arr::get($data, 'relatable_id');
            $notification->relatable_type = Arr::get($data, 'relatable_type');
            unset($data['relatable_type']);
            unset($data['relatable_id']);
            $notification->data = $data;
        });
    }

    public function relatable(): MorphTo
    {
        return $this->morphTo('relatable', 'relatable_type', 'relatable_id');
    }

    abstract public function name(): string;

    abstract public function logo(): string;
}
