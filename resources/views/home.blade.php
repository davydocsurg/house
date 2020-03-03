@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <?php $posts = new App\Post; ?>

                    @if("count($posts) > 0")

                        @foreach($posts->all() as $post)
                            <h4 class="card-title card-text-center">{{ $post->post_title}}</h4>
                            <img src="{{ $post->post_image}}" alt="" style="height:14rem;">
                            <p>{{ substr($post->post_body,0,150) }}</p>


                    <ul class="nav nav-pils " style="">
                        <li role="presentation">
                        <a href='{{url("/view/{$post->id}")}}' class="p-2">
                                <span><i class="fas fa-eye"></i> View </span>
                        </a>
                        </li>
                    </ul>
                        <cite >Posted on: {{date('M,j,Y H:i', strtotime($post->updated_at))}}</cite>
                                <hr>

                    @endforeach

                    @else
                        <p>No Posts</p>
                    @endif

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
