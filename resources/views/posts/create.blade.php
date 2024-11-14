@extends('layouts.app')
 
 @section('title', '新規投稿')
 
 @section('content')
     @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif
 
     <div class="mb-2">
         <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
     </div>
 
     <form action="{{ route('posts.store') }}" method="POST">
         @csrf
         <div class="form-group mb-3">
             <label for="title">タイトル</label>
             <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
         </div>
         <div class="form-group mb-3">
             <label for="content">本文</label>
             <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
         </div>
         <button type="submit" class="btn btn-outline-primary">投稿</button>
     </form>
 @endsection
     {{-- Bootstrap --}}
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 </body>
 
 </html>