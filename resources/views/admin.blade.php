@extends('layouts.ad')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
             </div>
        @endif
            <div class="card ">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                <?php $posts = new App\Post; ?>

                @if("count($posts) > 0")

                @foreach($posts->all() as $post)
                    <h4 class="card-title card-text-center">{{ $post->post_title}}</h4>
                   <a href="{{url('/view/{$post->id}')}}"> <img src="{{ $post->post_image}}" alt="" style="height:14rem;"></a>
                    <p>{{ substr($post->post_body,0,150) }}</p>

                    <ul class="nav nav-pils " style="">
                        <li role="presentation">
                        <a href='{{url("/view/{$post->id}")}}' class="p-2">
                                <span class="fas fa-eye"> </span>
                        </a>
                        </li>
                        
                        <li role="presentation">
                        <a href='{{url("/edit/{$post->id}")}}' class="p-2">
                                <span class="fa fa-pen-square"></span>
                        </a>
                        </li>

                        <li role="presentation">
                        <a href='{{url("/delete/{$post->id}")}}' class="p-2">
                                <span class="fa fa-trash"></span>
                        </a>
                        </li>
                    </ul>
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
