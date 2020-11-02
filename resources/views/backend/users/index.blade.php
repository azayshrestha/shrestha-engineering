@extends('backend.includes.layout')

@section('title')
    Manage Users
@stop

@section('formHeader')
    Manage Users
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="" class="btn btn-info" data-toggle="modal" data-target="#addUser">Add User</a>
    <hr>
    <div class="card">
        <div class="card-body">
        <table class="table dtable" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key=>$user)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>

                    <td>
                        <a href="#editUser" class="btn btn-primary" data-toggle="modal" title="Edit User" data-target="#editUser{{$user->id}}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$user->id}}" title="Delete User"><i class="fa fa-trash"></i></a>
                    </td>

                    <div class="modal" id="delete{{$user->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="{{route('user.destroy', $user->id)}}">
                                @method('DELETE')
                                {{@csrf_field()}}
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="fa fa-trash-o"></i> Delete Confirmation!</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to remove this record?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal" id="addUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">

                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{old('first_name')}}" required>
                                    @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{old('last_name')}}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @foreach($users as $user)
        <div class="modal" id="editUser{{$user->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                    {{@csrf_field()}}
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{$user->first_name}}" required>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{$user->last_name}}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$user->email}}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{old('password')}}">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" value="{{old('password_confirmation')}}">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <small class="pl-3">* If you dnt want to change password, leave Password Field Blank.</small>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-info">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@stop