@extends('backend.includes.layout')

@section('title')
    Testimonials
@stop

@section('formHeader')
    Testimonials
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="" class="btn btn-info" data-toggle="modal" data-target="#addTestimonial">Add Testimonial</a>
    <hr>
    <div class="card">
        <div class="card-body">
        <table class="table dtable" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Client</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($testimonials as $key=>$testimonial)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <img src="{{asset('images/testimonialImage/'.$testimonial->image)}}" class="rounded-circle  " width="50px" height="50px">
                    </td>
                    <td>{{$testimonial->name}}</td>

                    <td>
                        <a href="#editTestimonial" class="btn btn-primary" data-toggle="modal" title="Edit Testimonial" data-target="#editTestimonial{{$testimonial->id}}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$testimonial->id}}" title="Delete Testimonial"><i class="fa fa-trash"></i></a>
                    </td>

                    <div class="modal" id="delete{{$testimonial->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="{{route('testimonial.destroy', $testimonial->id)}}">
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
    <div class="modal" id="addTestimonial">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Testimonial</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="{{route('testimonial.store')}}" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- Modal body -->
                    <div class="modal-body">

                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" value="{{old('designation')}}" required>
                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Organization</label>
                                    <input type="text" name="organization" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" value="{{old('organization')}}" required>
                                    @if ($errors->has('organization'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{old('image')}}" required>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Testimonial</label>
                                    <textarea name="description" rows="4" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
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

    @foreach($testimonials as $testimonial)
        <div class="modal" id="editTestimonial{{$testimonial->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="{{route('testimonial.update', $testimonial->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                    {{@csrf_field()}}
                    <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$testimonial->name}}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Designation</label>
                                    <input type="text" name="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" value="{{$testimonial->designation}}" required>
                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Organization</label>
                                    <input type="text" name="organization" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" value="{{$testimonial->organization}}" required>
                                    @if ($errors->has('organization'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" value="$testimonial->image}}" required>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 form-group">
                                    <label>Testimonial</label>
                                    <textarea name="description" rows="4" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{$testimonial->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
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