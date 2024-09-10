@extends('admin.layout.master')

@section('title')
Edit Post
@endsection

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Post
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{route('admin.post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" 
                                @if($post->category_id == $category->id) 
                                    selected 
                                @endif > {{$category->name}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" value="{{$post->title}}" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description" value="{{$post->description}}" />
                    </div>
                    <div class="form-group">
                        <label>New Post</label>
                        <input name="new_post" type="checkbox" 
                        @if ($post->new_post) checked @endif />

                        <label>Highlight Post</label>
                        <input name="highlight_post" type="checkbox" 
                        @if ($post->highlight_post) checked @endif/>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input class="form-control" name="image" type="file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea id="demo" class="ckeditor form-control" name="content">
                            {!! $post->content!!}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Post Update</button>

                    @if (count($errors))
                        <div class="form-group">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="alert alert-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection