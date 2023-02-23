<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}
    <div class="flex justify-end p-2">
            <div class=" w-12 h-12 text-gray-900 dark:text-gray-100 rounded-full dark:bg-gray-800 overflow-hidden shadow-sm ">
                <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
    </div>

    @foreach($posts as $post)
        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 flex items-center">
                        <img class="rounded-full" src="https://i.pinimg.com/originals/0d/b5/e5/0db5e539765c3999422da4ee4fa1cbb9.jpg" width="70px" height="70px" alt="">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{$post->user->name}}
                        </div>
                    </div>
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        {{$post->content}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>
