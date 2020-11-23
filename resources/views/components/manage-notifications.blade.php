<div>
    <h1 class="text-2xl font-bold md:text-4xl">@lang('hermes::pages.notifications.page_title')</h1>

    <div class="flex flex-col">
        <div class="flex flex-row justify-between mt-4 text-base font-semibold">
            <div class="relative flex flex-row mb-2 space-x-2 sm:static">
                <div class="relative">
                    <div class="flex items-center justify-center w-10 h-10 border border-solid rounded cursor-pointer text-theme-secondary-400 border-theme-secondary-200 hover:text-theme-primary-500 focus:outline-none" wire:click="{{ $this->hasAllSelected ? 'deselectAllNotifications' : 'selectAllNotifications' }}">
                        @if($this->hasAllSelected)
                            <div class="flex items-center justify-center w-5 h-5 rounded-full bg-theme-success-500">
                                @svg('checkmark', 'text-white h-3 w-3')
                            </div>
                        @else
                            @svg('circle', 'h-5 w-5')
                        @endif
                    </div>
                </div>

                <div class="relative w-36">
                    <x-ark-dropdown dropdown-classes="left-0 w-36 mt-3" button-class="h-10 w-36 dropdown-button">
                        @slot('button')
                            <div class="inline-flex items-center justify-center w-full">
                                <span class="w-full ml-4 font-semibold text-left text-theme-secondary-900">
                                    {{ ucfirst($this->activeFilter) }}
                                </span>

                                <span :class="{ 'rotate-180': open }" class="mr-4 transition duration-150 ease-in-out text-theme-primary-600">
                                    @svg('chevron-down', 'h-3 w-3')
                                </span>
                            </div>
                        @endslot
                        <div class="py-3">
                            @foreach ($this->getAvailableFilters() as $filter)
                                <div class="cursor-pointer dropdown-entry" wire:click="$set('activeFilter', '{{ $filter }}')">
                                    @lang("hermes::menus.notifications-dropdown.{$filter}")
                                </div>
                            @endforeach
                        </div>
                    </x-ark-dropdown>
                </div>

                <div class="w-10 sm:relative">
                    <x-ark-dropdown wrapper-class="top-0 right-0 inline-block text-left sm:absolute" dropdown-classes="left-0 w-64 mt-3" button-class="w-10 h-10 text-theme-primary-600 dropdown-button">
                        <div class="py-3">
                            <div class="cursor-pointer dropdown-entry" wire:click="markSelectedAsRead">
                                @lang('hermes::menus.notifications-dropdown.mark_selected_as_read')
                            </div>

                            <div class="cursor-pointer dropdown-entry" wire:click="markSelectedAsUnread">
                                @lang('hermes::menus.notifications-dropdown.mark_selected_as_unread')
                            </div>

                            <div class="cursor-pointer dropdown-entry" wire:click="markSelectedAsStarred">
                                @lang('hermes::menus.notifications-dropdown.mark_selected_as_starred')
                            </div>

                            <div class="cursor-pointer dropdown-entry" wire:click="markSelectedAsUnstarred">
                                @lang('hermes::menus.notifications-dropdown.unstar_selected')
                            </div>

                            <div class="cursor-pointer dropdown-entry" wire:click="deleteSelected">
                                @lang('hermes::menus.notifications-dropdown.mark_selected_as_delete')
                            </div>
                        </div>
                    </x-ark-dropdown>
                </div>
            </div>
            <span class="hidden sm:flex justify-end items-center link">@lang('hermes::actions.mark_all_as_read')</span>
        </div>

        <span class="flex sm:hidden items-center link mt-2">@lang('hermes::actions.mark_all_as_read')</span>

        @if ($notificationCount > 0 && $this->notifications->count() > 0)
            @foreach($this->notifications as $notification)
                <div class="pt-2">
                    <div class="flex rounded-lg {{ $this->getStateColor($notification) }} px-6 py-5 cursor-pointer" wire:click="$emit('markAsRead', '{{ $notification->id }}')">
                        <div class="flex w-full">
                            @if ($this->isNotificationSelected($notification->id))
                                <div class="box-border flex justify-center flex-shrink-0 w-5 h-5 mr-4 rounded-full cursor-pointer bg-theme-success-500" wire:click.stop="$emit('setNotification', '{{ $notification->id }}')">
                                    <button type="button">
                                        @svg('checkmark', 'text-white h-3 w-3')
                                    </button>
                                </div>
                            @elseif ($notification->unread())
                                <div class="box-border flex flex-shrink-0 w-5 h-5 mr-4 border-2 rounded-full cursor-pointer border-theme-primary-500" wire:click.stop="$emit('setNotification', '{{ $notification->id }}')"></div>
                            @else
                                <div class="box-border flex flex-shrink-0 w-5 h-5 mr-4 border-2 rounded-full cursor-pointer" wire:click.stop="$emit('setNotification', '{{ $notification->id }}')"></div>
                            @endif

                            <div class="flex justify-between w-full">
                                <div class="flex flex-col w-full sm:flex-row">
                                    <div class="flex">
                                        <x-hermes-notification-icon
                                            :logo="$notification->logo()"
                                            :type="$notification->data['type']"
                                            :state-color="$this->getStateColor($notification)"
                                        />

                                        <div class="flex justify-end w-full sm:hidden">
                                            <div class="flex-inline">
                                                <span class="text-xs whitespace-no-wrap text-theme-secondary-400">
                                                    {{ $notification->created_at_local->diffForHumans() }}
                                                </span>

                                                <button class="align-middle" wire:click="deleteNotification('{{ $notification->id }}')">@svg('trash', 'h-4 w-3 ml-2 text-theme-secondary-400 cursor-pointer hover:text-theme-primary-500')</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex-col mt-4 sm:mt-0 sm:ml-4">
                                        <div class="inline-flex items-center space-x-5">
                                            <h3 class="text-xl font-semibold">{{ $notification->name() }}</h3>
                                            <span>
                                                @if ($notification->is_starred)
                                                    <button class="transition-default" wire:click.stop="$emit('markAsUnstarred', '{{ $notification->id }}')">
                                                        @svg('star', 'h-4 w-4 text-theme-warning-200')
                                                    </button>
                                                @else
                                                    <button class="transition-default" wire:click.stop="$emit('markAsStarred', '{{ $notification->id }}')">
                                                        @svg('star-outline', 'h-4 w-4')
                                                    </button>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="leading-5 text-theme-secondary-600">
                                            <div class="flex flex-col sm:block">
                                                <span>{{ $notification->data['content'] }}</span>
                                                @isset($notification->data['action'])
                                                    <a href="{{ $notification->data['action']['url'] }}" class="font-semibold link">{{ $notification->data['action']['title'] }}</a>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="items-start hidden sm:flex">
                                    <span class="text-xs whitespace-no-wrap text-theme-secondary-400">
                                        {{ $notification->created_at_local->diffForHumans() }}
                                    </span>

                                    <button wire:click.stop="deleteNotification('{{ $notification->id }}')">@svg('trash', 'h-4 w-3 ml-2 text-theme-secondary-400 cursor-pointer hover:text-theme-primary-500')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (! $loop->last)
                    <div class="px-10">
                        <hr class="mt-2 border-b border-dashed border-theme-secondary-200" />
                    </div>
                @endif
            @endforeach

            @if ($notificationCount > $this->notifications->perPage())
                <div class="flex justify-center mt-5">
                    {{ $this->notifications->links('vendor.ark.pagination') }}
                </div>
            @endif
        @else
            <div class="p-4 mt-5 border-2 rounded cursor-pointer border-theme-secondary-200">
                <span>
                    @if (ARKEcosystem\Hermes\Enums\NotificationFilterEnum::isAll($this->activeFilter))
                        @lang('hermes::menus.notifications.no_notifications')
                    @else
                        @lang('hermes::menus.notifications.no_filtered_notifications', ['filter' => $this->activeFilter])
                    @endif
                </span>
            </div>
            <div class="mt-5">
                <div class="md:block">
                    <img class="p-2" src="{{ asset('images/defaults/no-notifications-page.svg') }}"/>
                </div>
            </div>
        @endif
    </div>
</div>
