<div class="group">
    @if($this->notificationsUnread ?? false)
        <span class="absolute right-0 block p-1 mr-2 -mt-4 bg-white rounded-full group-hover:bg-theme-primary-100">
            <span class="block w-1 h-1 rounded-full border-3 bg-theme-danger-500 border-theme-danger-500"></span>
        </span>
    @endif
</div>
