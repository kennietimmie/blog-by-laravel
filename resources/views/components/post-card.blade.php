 @props(['post',])
 <article {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
   <div class="py-6 px-5">
     <div>
       <img  src="{{  $post->thumbnail ? asset( 'storage/' . $post->thumbnail) : asset('/images/illustration-1.png')}}" alt="Blog Post illustration" class="rounded-xl">
     </div>

     <div class="mt-8 flex flex-col justify-between">
       <header>
        <x-post-categories-card :categories="$post->categories" />
         <div class="mt-4">
           <a href="{{ route('posts.single', ['post' => $post->slug]) }}">
             <h1 class="text-3xl">{{ $post->title }}</h1>
           </a>

           <span class="mt-2 block text-gray-400 text-xs">
             Published <time>{{ $post->created_at->diffForHumans() }}</time>
           </span>
         </div>
       </header>
       <div class="text-sm mt-2 space-y-4">{!! $post->excerpt !!}</div>
       <footer class="flex justify-between items-center mt-8">
         <div class="flex items-center text-sm">
           <img src="https://i.pravatar.cc/60?u={{ $post->author->username }}" alt="Lary avatar" class="rounded-xl">
           <div class="ml-3">
             <h5 class="font-bold"><a href="{{route('posts.author', ['author' => $post->author->username])}}">{{$post->author->name }}</a></h5>
             <h6>Mascot at Laracasts</h6>
           </div>
         </div>

         <div class="hidden lg:block">
           <a href="{{ route('posts.single', ['post' => $post->slug]) }}"
             class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">Read
             More</a>
         </div>
       </footer>
     </div>
   </div>
 </article>
