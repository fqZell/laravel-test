@extends('layout.layout')

@section('page_title', 'Update Article: ' . $article->title)

@section('content')
    <section id="main">
        <div class="container">

            @if($errors->any())

                @foreach($errors->all() as $error)

                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                @endforeach

            @endif

            <form action="{{ route('article.update', $article) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="{{ $article->title }}">
                </div>

                <div class="form-group">
                    <label for="title">Short Text:</label>
                    <input type="text" name="short_text" id="title" value="{{ $article->short_text }}">
                </div>

                <div class="form-group">
                    <label for="title">Content:</label>
                    <textarea name="content" id="content" cols="30" rows="10">{{ $article->content }}</textarea>
                </div>

                <div class="image-preview">
                    <img src="{{ $article->image_url }}" alt="">
                </div>

                <style>
                    .image-preview {
                        height: 400px;
                    }

                    .image-preview img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                </style>

                <div class="form-group">
                    <label for="title">Photo:</label>
                    <input type="file" name="photo" id="photo">
                </div>

                <br/>

                <button class="button">Update Article</button>
            </form>
        </div>
    </section>
@endsection
