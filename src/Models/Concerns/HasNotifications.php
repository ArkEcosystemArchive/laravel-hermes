<?php

namespace ARKEcosystem\Hermes\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\RoutesNotifications;

trait HasNotifications
{
    use RoutesNotifications;

    public function notifications(): MorphMany
    {
        return $this
            ->morphMany(config('hermes.models.notification'), 'notifiable')
            ->orderBy('created_at', 'desc')
            ->orderBy('id');
    }

    public function readNotifications(): Builder
    {
        return $this->notifications()->whereNotNull('read_at');
    }

    public function unreadNotifications(): Builder
    {
        return $this->notifications()->whereNull('read_at');
    }

    public function starredNotifications(): MorphMany
    {
        return $this->notifications()->where('is_starred', true);
    }

    public function hasUnreadNotifications(): bool
    {
        $latestNotification = $this->notifications()->latest()->first();

        if (! $latestNotification) {
            return false;
        }

        return $latestNotification->created_at->gte($this->seen_notifications_at);
    }
}
