@extends('layouts.app')
 
 @section('title', '投稿詳細')
 
 @section('content')
     @if (session('flash_message'))
         <p class="text-success">{{ session('flash_message') }}</p>
     @endif
 
     <div class="mb-2">
         <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
     </div>
 
     <article>
         <div class="card mb-3">
             <div class="card-body">
                 <h2 class="card-title fs-5">{{ $post->title }}</h2>
                 <p class="card-text">{{ $post->content }}</p>
                 <p class="card-text my-3">{{ $post->updated_at }}</p>
 
 
                 @if ($post->user_id === Auth::id())
                    <div class="d-flex">
                        <form action="{{ route('posts.edit', $post) }}" method="GET">
                            <button type="submit" class="btn btn-outline-primary me-1 show_edit">編集</button>
                        </form>

 
                         <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                             @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-outline-danger">削除</button>
                         </form>
                     </div>
                 @endif
             </div>
         </div>
     </article>
 @endsection
     {{-- Bootstrap --}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 </body>
 
 </html>