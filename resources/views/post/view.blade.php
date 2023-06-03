<x-app-layout :meta-title="$post->meta_title ?: $post->title" :meta-description="$post->meta_description">
    <div class="flex">
        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col px-3">

            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="#" class="hover:opacity-75">
                    <img src="{{$post->getThumbnail()}}">
                </a>
                <div class="bg-white flex flex-col justify-start p-6">
                    <div class="flex gap-4">
                        @foreach($post->categories as $category)
                            <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">
                                {{$category->title}}
                            </a>
                        @endforeach
                    </div>
                    <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                        {{$post->title}}
                    </h1>
                    <p href="#" class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-gray-800">{{$post->user->name}}</a>, Опубліковано
                        {{$post->getFormattedDate()}} | {{ $post->human_read_time }}
                    </p>
                    <div>
                        {!! $post->body !!}
                    </div>

                    <livewire:upvote-downvote :post="$post"/>
                </div>
            </article>

            <div class="w-full flex flex-col pt-6 sm:flex-row sm:items-center">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0 sm:pr-2">
                    @if($prev)
                        <a href="{{route('view', $prev)}}"
                           class="block w-full bg-white shadow hover:shadow-md text-left p-6 rounded-lg border border-gray-300">
                            <p class="text-lg text-blue-800 font-bold flex items-center text-sm sm:text-lg">
                                <i class="fas fa-arrow-left pr-1"></i>
                                Попередня
                            </p>
                            <p class="pt-2">{{\Illuminate\Support\Str::words($prev->title, 5)}}</p>
                        </a>
                    @endif
                </div>
                <div class="w-full sm:w-1/2">
                    @if($next)
                        <a href="{{route('view', $next)}}"
                           class="block w-full bg-white shadow hover:shadow-md text-right p-6 rounded-lg border border-gray-300">
                            <p class="text-lg text-blue-800 font-bold flex items-center justify-end text-sm sm:text-lg">
                                Наступна <i class="fas fa-arrow-right pl-1"></i>
                            </p>
                            <p class="pt-2">{{\Illuminate\Support\Str::words($next->title, 5)}}</p>
                        </a>
                    @endif
                </div>
            </div>


            <livewire:comments :post="$post"/>
        </section>

        <x-sidebar/>
    </div>
</x-app-layout>
