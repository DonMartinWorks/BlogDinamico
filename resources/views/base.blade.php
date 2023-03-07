<x-main-layout>
    <!-- hero -->
    <div class="relative overflow-hidden bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-gray-900 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-gray-900 transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100"></polygon>
                </svg>

                <!-- Livewire navigation -->
                <livewire:navigation.navigation />

                <!-- livewire component -->
                <livewire:hero.info />

            </div>
        </div>

        <!-- livewire component -->
        <livewire:hero.image />
    </div>

    <!-- Projects -->
    <div class="bg-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- livewire component -->
            <livewire:project.project />
        </div>
    </div>

    <!-- Footer -->
    <section class="bg-gray-900">
        <div class="flex justify-center pt-10">
            <h2 class="text-2xl font-extrabold text-gray-500">Contáctame</h2>
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
            <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                <!-- livewire component -->
                <div class="px-5 py-2" id="{{ __('contact') }}">

                    <a href="mailto:email@email.com"
                        class="flex text-base leading-6 text-emerald-600 hover:text-white space-y-1">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6">
                            <path
                                d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                            <path
                                d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                        </svg>

                        <span class="pl-3 text-lg">email@email.com</span>
                    </a>
                    <!-- Boton edit -->

                    <!-- SlideOver -->
                </div>
            </nav>

            <!-- livewire component -->
            <div class="flex justify-center mt-8 space-x-6">
                <a href="#" target="_blank" class="text-4xl text-emerald-600 hover:text-purple-400">
                    <span class="sr-only">Linkedin</span>
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="#" target="_blank" class="text-4xl text-emerald-600 hover:text-purple-400">
                    <span class="sr-only">Github</span>
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="#" target="_blank" class="text-4xl text-emerald-600 hover:text-purple-400">
                    <span class="sr-only">Twitter</span>
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <!-- Boton add and edit -->

                <!-- SlideOver -->
            </div>

            <!-- livewire component  -->
            <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                <a href="#" class="font-medium px-5 py-2 text-gray-200 hover:text-purple-400">Link 1</a>
                <a href="#" class="font-medium px-5 py-2 text-gray-200 hover:text-purple-400">Link 2</a>
                <a href="#" class="font-medium px-5 py-2 text-gray-200 hover:text-purple-400">Link 3</a>
                <!-- Boton Logout -->
            </nav>
        </div>
    </section>
</x-main-layout>
