<?php

namespace ARKEcosystem\Hermes\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasNotifications
{
    public function notifications(): MorphMany
    {
        return $this
            ->morphMany(config('hermes.models.notification'), 'notifiable')
            ->orderBy('created_at', 'desc')
            ->orderBy('id');
    }

    public function starredNotifications(): MorphMany
    {
        return $this->notifications()->where('is_starred', true);
    }

    public function hasNewNotifications(): bool
    {
        $latestNotification = $this->notifications()->latest()->first();

        if (! $latestNotification) {
            return false;
        }

        return $latestNotification->created_at->gte($this->seen_notifications_at);
    }
}
