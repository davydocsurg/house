@extends('layouts.ad')

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                  <div class="row">
                  <form method="POST" action="{{ url('/addPost') }}" enctype="multipart/form-data">
                        @csrf
<!-- title starts -->
                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="post_title" type="input" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ old('post_title') }}" required autocomplete="post_title" autofocus>

                                @error('post_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- titleends -->
                        <div class="form-group row">
                            <label for="post_body" class="col-md-4 col-form-label text-md-right">Post body</label>

                            <div class="col-md-6">
                                <textarea id="post_body" rows="8" class="form-control @error('post_body') is-invalid @enderror" name="post_body" required autocomplete="post_body"> </textarea>

                                @error('post_body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- body end -->
                        <div class="form-group row">
                            <label for="post_body" class="col-md-4 col-form-label text-md-right">Choose Category</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required autocomplete="category_id">
                                    <option value="">Select</option>

                                    @if(count($categories) > 0)

                                        @foreach($categories->all() as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>  
                                        @endforeach
                                    @endif
                                 </select>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- file ends -->
                        <div class="form-group row">
                            <label for="post_image" class="col-md-4 col-form-label text-md-right">Featured Image</label>

                            <div class="col-md-6">
                                <input id="post_image" type="file" class="form-control @error('post_image') is-invalid @enderror" name="post_image" required autocomplete="post_image">

                                @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- select ends -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-large btn-block">
                                    Publish
                                </button>

                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection