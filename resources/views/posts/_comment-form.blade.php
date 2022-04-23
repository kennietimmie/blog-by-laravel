 <x-auth-validation-errors class="mb-4" :errors="$errors" />
 @auth
   <x-panel>
     <form method="post" action="{{ route('posts.comment.store', ['post' => $post->slug]) }}">
       @csrf
       <header class="flex items-center">
         <img src="https://i.pravatar.cc/40?u={{$post->author->username}}" alt="" width="40" height="40" class="rounded-full" />
         <h3 class="ml-3 text-sm">Want to participate?</h3>
       </header>
       <div class="mt-3">
         <x-form.textarea :name="'comment'" :value="old('comment')" placeholder="Thinking of something to say?" id="comment" cols="10" rows="5">{{old('comment')}}</x-form.textarea>
       </div>
       <div>
         <x-form.button class="mt-3"> {{ __('Comment') }}</x-form.button>
       </div>
     </form>
   </x-panel>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', () => {
        const posts = @json(App\Models\Post::latest()->take(10)->get());

        posts.forEach((post) => {
          // Private Channels
          const channel = Echo.private(`pre-activities.${post.id}`);

          // listen to whisper for typing
          channel.listenForWhisper('typing a comment', (e) => {
            console.log(e);
          }).listen('.activity-monitor', function(e) {
            console.log(...e)
          });

          // js add event listener
          document.querySelector('#comment').addEventListener('keyup', function (e) {
            // whisper typing to channel
            channel.whisper('typing a comment',{
              user: @json(auth()->user()),
              typing: true
            });
          });

        });

      });
    </script>

 @else
   <p class="text-sm font-semibold">You have to login to comment</p>
 @endauth
