<div class="flex-1 px-8 md:px-10">
    @if(Auth::check() && $notificationCount > 0)
        <div class="inline-block w-full py-4 md:py-4">
            @foreach($currentUser->notifications->take(4) as $notification)
                <div class="flex px-2 py-6 leading-5 {{ ! $loop->last ? 'border-b border-dashed border-theme-secondary-200' : '' }}">
                    <x-hermes-notification-icon
                        :logo="$notification->logo()"
                        :type="$notification->data['type']"
                    />
                    <div class="flex flex-col w-full ml-5 space-y-1">
                        <div class="flex flex-row justify-between">
                            <span class="font-semibold text-theme-secondary-900 @if(strlen($notification->name()) > 32)notification-truncate @endif">
                                {{ $notification->name() }}
                            </span>

                            <span class="hidden text-sm text-theme-secondary-400 sm:block sm:text-right sm:w-full">
                                {{ $notification->created_at_local->diffForHumans() }}
                            </span>
                        </div>

                        <div class="flex flex-col justify-between md:space-x-3 sm:flex-row">
                            <span class="notification-truncate">
                                {{ $notification->data['content'] }}
                            </span>

                            <div class="flex flex-row space-x-4">
                                @isset($notification->data['action'])
                                    <span class="mt-1 font-semibold whitespace-nowrap link sm:mt-0">
                                        <a href="{{ $notification->data['action']['url'] }}">{{ $notification->data['action']['title'] }}</a>
                                    </span>
                                @endisset

                                <span class="block mt-1 text-sm sm:hidden text-theme-secondary-400">
                                    {{ $notification->created_at_local->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="flex flex-row justify-center w-full px-2 pb-6 mt-4">
                <a href="{{ route('user.notifications') }}" class="w-full cursor-pointer button-secondary">
                    {{ $notificationCount > 4 ? trans('hermes::actions.show_all') : trans('hermes::actions.open_notifications') }}
                </a>
            </div>
        </div>
    @else
        <div class="p-4 mt-5 text-center border-2 rounded border-theme-secondary-200">
            <span>@lang('hermes::menus.notifications.no_notifications')</span>
        </div>
        <div class="mt-5">
            <img class="p-2" src="{{ asset('images/defaults/no-notifications-navbar.svg') }}"/>
        </div>
    @endif
</div>