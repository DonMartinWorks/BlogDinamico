<form wire:submit.prevent="save">
    <div>
        <x-inputs.label for="socialLinkName" value="{{ __('Name') }}" />

        <x-inputs.text wire:model.defer="socialLink.name" id="socialLinkName" type="text" required />

        @error('socialLink.name')
            <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-4">
        <x-inputs.label for="socialLinkUrl" value="{{ __('Url') }}" />

        <x-inputs.text wire:model.defer="socialLink.url" id="socialLinkUrl" type="text" required />

        @error('socialLink.url')
            <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-4">
        <x-inputs.label for="icon" value="{{ __('Font Awesome Icon') }}" />

        <x-inputs.text wire:model.defer="socialLink.icon" id="icon" placeholder="fa-brands fa-twitter"
            type="text" />

        <div class="mt-3 flex items-center justify-center">
            <span class="text-sm text-gray-400">{{ __('You can find the icon you need') }} <a
                    href="https://fontawesome.com/icons" target="_blank"
                    class="text-purple-600 hover:text-purple-400">{{ __('here') }}</a></span>
        </div>

        @error('socialLink.icon')
            <div class="mt-1 text-red-600 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-4 flex items-center justify-between">
        <x-primary-button class="my-6 w-full justify-center py-3">{{ __('Save') }}</x-primary-button>
    </div>
</form>
