<div class="mt-4">
    {{-- Do your work, then step back. --}}
    @if (!$post->likedBy(auth()->user()))
        <form wire:submit.prevent='like' class="flex">
            @csrf
            <button type="submit" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:hover:fill-slate-500 hover:fill-slate-300" fill='none'>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                </svg>              
            </button>
            <span class="align-text-top ml-2 cursor-pointer" onclick="$openModal('postLikedList-{{$post->id}}')">{{$post->likes()->count()}} {{Str::plural('like', $post->likes()->count())}}</span>
        </form>
    @else
        <form wire:submit.prevent='unlike' class="flex">
            @csrf
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 hover:fill-slate-300 dark:hover:fill-slate-300">
                    <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
                  </svg>              
            </button>
            <span class="align-text-top ml-2 cursor-pointer" onclick="$openModal('postLikedList-{{$post->id}}')"> {{$post->likes()->count()}} {{Str::plural('like', $post->likes()->count())}}</span>
        </form>
    @endif

    <x-modal blur wire:model.defer="postLikedList-{{$post->id}}" align='center'>
        <x-card title="Post liked by">
            <ul class="text-gray-600 dark:text-white">
                @if (count($post->likes)) 
                    @foreach ($post->likes as $like)
                    <li class="mt-2 rounded shadow dark:border-transparent dark:shadow-slate-900  border p-3">
                        <a href="" class="font-bold">{{ $like->user->name }}</a>
                        <span>{{ $like->created_at->diffForHumans() }}</span>
                    </li>
                    @endforeach
                @else
                    <p>Post has no recent likes :( </p>
                @endif
            </ul>
     
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Close" x-on:click="close" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
   
</div>
