@extends('backend.includes.layout')

@section('title')
    Manage Team
@stop

@section('formHeader')
    Manage Team
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="" class="btn btn-info" data-toggle="modal" data-target="#addTeam">Add Team Member</a>
    <hr>
    <div class="card">
        <div class="card-body">
        <table class="table dtable" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Team Member</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teams as $key=>$team)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <img src="{{asset('images/teamImage/'.$team->image)}}" class="rounded-circle  " width="50px" height="50px">
                    </td>
                    <td>{{$team->name}}<br><span class="text-muted">{{$team->designation}}</span></td>
                    <td>
                        @if($team->status == 1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">In-Active</span>
                        @endif
                    </td>
                    <td>
                        <a href="#editTeam" class="btn btn-primary" data-toggle="modal" title="Edit Team" data-target="#editTeam{{$team->id}}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$team->id}}" title="Delete Team"><i class="fa fa-trash"></i></a>
                    </td>

                    <div class="modal" id="delete{{$team->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="{{route('team.destroy', $team->id)}}">
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
    <div class="modal" id="addTeam">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Team Member</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route('team.store')}}" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">

                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" value="{{old('designation')}}" required>
                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" required>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Facebook</label>
                                    <input type="url" name="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" value="{{old('facebook')}}">
                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Twitter</label>
                                    <input type="url" name="twitter" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" value="{{old('twitter')}}">
                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Instagram</label>
                                    <input type="url" name="instagram" class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}" value="{{old('instagram')}}">
                                    @if ($errors->has('instagram'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instagram') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>LinkedIn</label>
                                    <input type="url" name="linkedin" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" value="{{old('linkedin')}}">
                                    @if ($errors->has('linkedin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Status</label><br>
                                    <input type="radio" class="" name="status" value="1" checked> Active
                                    <input type="radio" class="ml-3"  name="status" value="0"> In-Active
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

    @foreach($teams as $team)
        <div class="modal" id="editTeam{{$team->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Team Member</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="{{route('team.update', $team->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                    {{@csrf_field()}}
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$team->name}}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" value="{{$team->designation}}" required>
                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" required>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Facebook</label>
                                    <input type="url" name="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" value="{{$team->facebook}}">
                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Twitter</label>
                                    <input type="url" name="twitter" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" value="{{$team->twitter}}">
                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Instagram</label>
                                    <input type="url" name="instagram" class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}" value="{{$team->instagram}}">
                                    @if ($errors->has('instagram'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('instagram') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>LinkedIn</label>
                                    <input type="url" name="linkedin" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" value="{{$team->linkedin}}">
                                    @if ($errors->has('linkedin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$team->email}}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Status</label><br>
                                    <input type="radio" class="" name="status" value="1" @if($team->status == 1) checked @endif> Active
                                    <input type="radio" class="ml-3"  name="status" value="0" @if($team->status == 0) checked @endif> In-Active
                                </div>
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