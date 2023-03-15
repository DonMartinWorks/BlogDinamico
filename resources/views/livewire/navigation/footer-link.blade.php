<nav class="flex flex-wrap justify-center -mx-5 -my-2">
    <x-navigation.links class="px-5 py-2 text-gray-200 hover:text-sky-500" :items="$items" />

    <form method="POST" action="{{ route('logout') }}" class="py-2">
        @csrf
        <a href="{{ route('logout') }}" title="{{ __('Log Out') }}" onclick="event.preventDefault(); this.closest('form').submit();"
            class="mr-5 rounded-xl text-white hover:text-red-600">
            <x-icons.arrow-right />
        </a>
    </form>
</nav>
