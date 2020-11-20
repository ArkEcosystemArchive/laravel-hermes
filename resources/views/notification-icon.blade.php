<div class="relative inline-block pointer-events-none avatar-wrapper">
    <div class="relative w-11 h-11">
        @isset($logo)
            <img class="object-cover rounded-md" src="{{ $logo }}" />
        @else
            <div class="border border-theme-secondary-200 w-11 h-11"></div>
        @endif

        <div
            class="absolute flex items-center justify-center text-transparent rounded-full avatar-circle shadow-solid"
            style="right: -0.8rem; top: -0.9rem;"
        >
            <div class="flex flex-shrink-0 items-center justify-center rounded-full {{ $stateColor ?? 'bg-white' }} h-7 w-7">
                @if ($type === 'danger')
                    <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-theme-danger-100">
                        @svg('danger', 'text-theme-danger-400 h-4 w-4')
                    </div>
                @elseif ($type === 'success')
                    <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-theme-success-100">
                        @svg('checkmark', 'text-theme-success-600 h-3 w-3')
                    </div>
                @elseif ($type === 'warning')
                    <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 rounded-full bg-theme-warning-100">
                        @svg('notification', 'text-theme-warning-600 h-3 w-3')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
