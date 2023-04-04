<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
    {{--            {{ __('Dashboard') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}
    <!-- Modal toggle -->
    <button data-modal-target="newTweet-modal" data-modal-toggle="newTweet-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
        New Tweet
    </button>
@foreach($posts as $index => $post)
        <div class="py-4">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 flex items-center">
                        <img class="rounded-full"
                             src="https://i.pinimg.com/originals/0d/b5/e5/0db5e539765c3999422da4ee4fa1cbb9.jpg"
                             width="70px" height="70px" alt="">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{$post->user->name}}
                        </div>
                        <div class="w-full flex justify-end">
                            <div class="w-1/5 flex justify-evenly">
                                <!-- Like button -->
                                <button id="likeButton" value="{{$post->id}}" type="button"
                                        class="bg-white flex justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" value="{{$post->likes[0]->id ?? 'none'}}"
                                         style="pointer-events: none" fill="{{ $post->likes->contains(fn ($elem) => $elem->user_id == Auth::user()->id) ? "red" : "none"}}"
                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                         class="hover:scale-110 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                                    </svg>
                                    <div>
                                        {{count($post->likes) ?? ""}}
                                    </div>
                                </button>
                                <!-- Comment button -->
                                <button data-modal-target="newComment-modal" class="flex flex-row"
                                        data-modal-toggle="newComment-modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z"/>
                                    </svg>

                                </button>
                                <!-- Dropdown button -->
                                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-{{$index}}"
                                        type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Dropdown menu -->
                        <div id="dropdown-{{$index}}"
                             class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                @if($post->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                    <li>
                                        <form action="{{route('post.destroy',$post->id)}}"
                                              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-black"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{route('save_post')}}"
                                              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-black"
                                              method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" value="{{$post->id}}" name="post_id">
                                            <button type="submit">Opslaan</button>
                                        </form>
                                    </li>
                                    {{--                                <li>--}}
                                    {{--                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>--}}
                                    {{--                                </li>--}}
                                    {{--                                <li>--}}
                                    {{--                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>--}}
                                    {{--                                </li>--}}
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        {{$post->content}}
                    </div>
                    @if(count($post->comments))
                        <div class="p-4 border-y-2 text-gray-900 dark:text-gray-100">
                            @foreach($post->comments as $comment)
                                <div class="p-2 text-gray-900 dark:text-gray-100">
                                    <div class="flex flex-row">
                                        <img class="rounded-full"
                                             src="https://i.pinimg.com/originals/0d/b5/e5/0db5e539765c3999422da4ee4fa1cbb9.jpg"
                                             width="70px" height="70px" alt="">
                                        <div class="p-4 text-gray-900 dark:text-gray-100">
                                            {{$comment->user->name}}
                                        </div>
                                    </div>
                                    {{$comment->comment}}
                                </div>
                            @endforeach

                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- newComment modal -->
        <div id="newComment-modal" tabindex="-1" aria-hidden="true"
             class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <form class="space-y-6" method="post" action="{{route('comment.store', $post->id)}}">
                            @method('post')
                            @csrf
                            <div>
                                <textarea style="resize: none;" name="comment"
                                          class="bg-gray-50 border resize:none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                          placeholder="What's the score" required></textarea>
                            </div>
                            <button type="submit"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Tweet
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    <!-- newTweet modal -->
    <div id="newTweet-modal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <form class="space-y-6" method="post" action="{{route('post.store')}}">
                        @method('post')
                        @csrf
                        <div>
                            <textarea style="resize: none;" name="input_field"
                                      class="bg-gray-50 border resize:none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                      placeholder="What's the score" required></textarea>
                        </div>
                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Tweet
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const likeButtons = document.querySelectorAll('#likeButton');
    likeButtons.forEach(postLike)

    function postLike(item, index) {
        item.addEventListener('click', (event) => {
            const key = event.target.getAttribute('value');

            if (event.target.firstChild.nextSibling.getAttribute('fill') === 'red') {
                event.target.firstChild.nextSibling.setAttribute('fill', 'none')
                const key = event.target.firstChild.nextSibling.getAttribute('value');
                postData(`/post/${key}/like`, {likeId: key}, "DELETE")
            } else {
                event.target.firstChild.nextSibling.setAttribute('fill', 'red')
                postData(`/post/${key}/like`, {postId: key}, "POST")
                    .then(response => response.text())
                    .then(data => event.target.firstChild.nextSibling.setAttribute('value', Number(data)))
            }
        })
    }

    async function postData(url = "", data = {}, method = "") {
        return fetch(url, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data),
        });
    }

</script>
