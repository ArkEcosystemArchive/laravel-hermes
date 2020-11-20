<div class="flex-1 px-6 pb-8">
    @if(Auth::check() && $notificationCount > 0)
        <div class="inline-block w-full py-5">
            @foreach($currentUser->notifications->take(4) as $notification)
                <div class="flex px-2 py-3 leading-5 {{ ! $loop->last ? 'border-b border-solid border-theme-secondary-100' : '' }}">
                    <x-ark-notification-icon
                        :logo="$notification->logo()"
                        :type="$notification->data['type']"
                    />
                    <div class="flex flex-col w-full ml-4 space-y-1">
                        <div class="flex flex-row justify-between">
                            <span class="font-semibold text-theme-secondary-900">
                                {{ $notification->name() }}
                            </span>

                            <span class="text-sm text-theme-secondary-400">
                                {{ $notification->created_at_local->diffForHumans() }}
                            </span>
                        </div>

                        <div class="flex flex-col justify-between space-x-3 sm:flex-row">
                            <span class="notification-truncate">
                                {{ $notification->data['content'] }}
                            </span>

                            @isset($notification->data['action'])
                                <span class="mt-1 font-semibold whitespace-no-wrap link sm:mt-0">
                                    <a href="{{ $notification->data['action']['url'] }}">{{ $notification->data['action']['title'] }}</a>
                                </span>
                            @endisset
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="flex flex-row justify-center w-full px-2 mt-4">
                <a href="{{ route('user.notifications') }}" class="w-full cursor-pointer button-secondary">
                    {{ $notificationCount > 4 ? trans('actions.show_all') : trans('actions.open_notifications') }}
                </a>
            </div>
        </div>
    @else
        <div class="p-4 mt-5 text-center border-2 rounded border-theme-secondary-200">
            <span>@lang('menus.notifications.no_notifications')</span>
        </div>
        <div class="mt-5">
            <img class="p-2" src="{{ asset('images/defaults/no-notifications-navbar.svg') }}"/>
        </div>
    @endif
</div>
