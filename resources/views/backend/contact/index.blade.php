@extends('backend.includes.layout')

@section('title')
Manage Contact Information
@stop

@section('formHeader')
Manage Contact Information
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')

@if(!$contact)
    <a href="" class="btn btn-info" data-toggle="modal" data-target="#addContact">Add Contact Details</a>
@else
    <a href="" class="btn btn-info" data-toggle="modal" data-target="#editContact">Update Contact Details</a>
@endif
<hr>


@if($contact != null)
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover" width="100%">
                        <tr>
                            <th width="25%">Organization Name</th>
                            <td>{{$contact->organization}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$contact->address}}</td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>{{$contact->contact}}</td>
                        </tr>
                        <tr>
                            <th>E-Mail</th>
                            <td>{{$contact->email}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <iframe src="{{$contact->map_url}}" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>

@endif

<!-- The Modal -->
<div class="modal" id="addContact">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Contact Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="{{route('contact.store')}}" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Organization Name</label>
                        <input type="text" name="organization" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" value="{{old('organization')}}" placeholder="Enter Organization Name">
                        @if ($errors->has('organization'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{old('address')}}" placeholder="Enter Address">
                        @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" name="contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" value="{{old('contact')}}" placeholder="Enter Contact Number">
                        @if ($errors->has('contact'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email')}}" placeholder="Enter E-Mail Address">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Google Map Url</label>
                        <input type="url" name="map_url" class="form-control{{ $errors->has('map_url') ? ' is-invalid' : '' }}" value="{{old('map_url')}}" placeholder="Enter Google Map Url">
                        @if ($errors->has('map_url'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
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

<!-- The Modal -->
@if($contact != null)
<div class="modal" id="editContact">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Contact Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" action="{{route('contact.update',$contact->id)}}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{@csrf_field()}}
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Organization Name <span class="red">*</span></label>
                        <input type="text" name="organization" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" value="{{$contact->organization}}" placeholder="Enter Organization Name">
                        @if ($errors->has('organization'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Address <span class="red">*</span></label>
                        <input type="text" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{$contact->address}}" placeholder="Enter Address">
                        @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Contact <span class="red">*</span></label>
                        <input type="text" name="contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" value="{{$contact->contact}}" placeholder="Enter Contact Number">
                        @if ($errors->has('contact'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email <span class="red">*</span></label>
                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$contact->email}}" placeholder="Enter E-Mail Address">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Google Map Url</label>
                        <input type="url" name="map_url" class="form-control{{ $errors->has('map_url') ? ' is-invalid' : '' }}" value="{{$contact->map_url}}" placeholder="Enter Google Map Url">
                        @if ($errors->has('map_url'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
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
@endif
@stop