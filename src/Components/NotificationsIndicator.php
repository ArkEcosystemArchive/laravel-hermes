<?php

namespace ARKEcosystem\Hermes\Components;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

final class NotificationsIndicator extends Component
{
    public $notificationsUnread;

    protected $listeners = ['markNotificationsAsSeen'];

    public function mount()
    {
        $this->notificationsUnread = Auth::user() ? Auth::user()->hasUnreadNotifications() : false;
    }

    public function markNotificationsAsSeen()
    {
        Auth::user()->update(['seen_notifications_at' => Carbon::now()]);

        $this->notificationsUnread = false;
    }

    public function render()
    {
        return view('hermes::components.notifications-indicator');
    }
}
