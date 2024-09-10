@extends('web.layout.master')

@section('content')

<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-gears bg-orange"></i> Category <small class="hidden-xs-down hidden-sm-down">Nulla
                        felis eros, varius sit amet volutpat non. </small></h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->


<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title">Category</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                @foreach($categories as $category)
                                <a href="{{route('web.category', $category->slug)}}"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <h5 class="mb-1">{{$category->name}}</h5>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div><!-- end col -->

            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-grid-system">
                        <div class="row">
                            @foreach($posts as $post)
                            <div class="col-md-6">
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="{{route('web.post', $post->slug)}}" title="">
                                            <img src="{{$post->imageUrl()}}" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div><!-- end hover -->
                                        </a>
                                    </div><!-- end media -->
                                    <div class="blog-meta big-meta">
                                        <span class="color-orange"><a href="{{route('web.category', $post->category->slug)}}"
                                                title="">{{$post->category->name}}</a></span>
                                        <h4><a href="{{route('web.post', $post->slug)}}">{{$post->title}}</a></h4>
                                        <p>{{$post->description}}</p>
                                        <small>{{\Carbon\Carbon::parse($post->created_at)->format('d-m-Y')}}</small>
                                        <small>{{$post->user->name}}</small>
                                        <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                                {{$post->view_counts}}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->
                            </div><!-- end col -->
                            @endforeach
                            
                        </div><!-- end row -->
                    </div><!-- end blog-grid-system -->
                </div><!-- end page-wrapper -->
                
                <hr class="invis3">

                <div class="row">
                    <div class="col-md-12">
                        {{$posts->links()}}
                    </div>
                </div>
            </div><!-- end col --> 
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection