@extends('backend.includes.layout')

@section('title')
    Manage Services
@stop

@section('formHeader')
    Manage Services
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="{{route('service.create')}}" class="btn btn-info">Add Services</a>
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table dtable" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Service Title</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $key=>$service)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$service->title}}</td>
                        <td>
                            @if($service->status == 1)
                                <span class="badge badge-success">Active</span>
                            @elseif($service->status ==0)
                                <span class="badge badge-danger">In-Active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('service.edit', $service->id)}}" class="btn btn-primary" title="Edit Slider"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$service->id}}" title="Delete Image"><i class="fa fa-trash"></i></a>
                        </td>

                        <!-- The Modal -->
                        <div class="modal" id="delete{{$service->id}}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <form method="post" action="{{route('service.destroy', $service->id)}}">
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
    </div>

@stop