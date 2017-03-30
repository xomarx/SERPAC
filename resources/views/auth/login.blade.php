@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body  class="hold-transition login-page" style="background-image: url('{{url('img/ERP-ACOPAGRO.png')}}'); background-repeat: no-repeat; background-size:100% 100%;">
    
    <div class="login-box" >        
        <div class="login-logo">            
            <a href="{{ url('/home') }}"> <img src="{{ url('img/acopagro.png') }}" class="img-responsive" ></a>
        </div><!-- /.login-logo -->

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg"> {{ trans('adminlte_lang::message.siginsession') }} </p>
            <form action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="text" id="name" class="form-control" placeholder="Usuario" name="name"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">            
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Session  <i class="fa fa-sign-in"></i></button>
                    </div><!-- /.col -->
                </div>
            </form>   

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('layouts.partials.scripts_auth')
</body>
@endsection
