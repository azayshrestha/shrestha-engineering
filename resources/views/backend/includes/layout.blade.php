@include('backend.includes.header')
@include('backend.includes.sidebar')




<div class="content-wrapper text-sm">
    <section class="content-header">
        <h1>
            @yield('formHeader')
            <small>@yield('formSubHeader')</small>
        </h1>

        <br>
        @if(session('success_msg'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-check"></i> Success!</h5>
                {{ session('success_msg') }}
            </div>
        @endif
        @if(session('error_msg'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-ban"></i> Error</h5>
                {{ session('error_msg') }}
            </div>
        @endif

        @if(count($errors)>0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-ban"></i> Error</h5>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                @yield('content')
            </div>
        </div>
    </section>

</div>
<meta name="csrf-token" content="{{ csrf_token() }}">



@include('backend.includes.footer')
