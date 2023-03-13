<div class="px-5 py-2" id="{{ __('contact') }}">

    @if ($contact->email)
        <a href="mailto:{{ $contact->email }}"
            class="flex text-base leading-6 text-emerald-600 hover:text-white space-y-1">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                <path
                    d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
            </svg>

            <span class="pl-3 text-lg">{{ $contact->email }}</span>
        </a>
    @else
        <h3 class="text-gray-400">{{ __('There is no contact email to show!') }}</h3>
    @endif

    <!-- Boton edit -->
    <x-actions.action wire:click.prevent="openSlide" title="{{ __('Edit') }}"
        class="flex items-center justify-center py-3 px-5 md:px-10 text-white hover:text-sky-500">
        <x-icons.pencil />
    </x-actions.action>

    <!-- SlideOver -->
</div>
