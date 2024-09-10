@extends('web.layout.master')

@section('content')
<div class="page-title lb single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h2><i class="fa fa-envelope-open-o bg-orange"></i>Login <small
                        class="hidden-xs-down hidden-sm-down">Nulla felis eros, varius sit amet volutpat non. </small>
                </h2>
            </div><!-- end col -->
            <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ol>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->
<br>

<section class="section wb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-wrapper" action="{{route('web.login')}}" method="POST">
                    @csrf
                    <input type="text" name="email" class="form-control" placeholder="Your Email">
                    <input type="password" name="password" class="form-control" placeholder="Your password">
                    <button type="submit" class="btn btn-primary">Login <i class="fa fa-envelope-open-o"></i></button>
                </form>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection