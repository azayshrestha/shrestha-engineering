@extends('backend.includes.layout')

@section('title')
    Project
@stop

@section('formHeader')
    Project
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <a href="{{route('project.create')}}" class="btn btn-info">Add Project</a>
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover dtable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($projects as $key=>$project)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$project->title}}</td>
                        <td>
                            @if($project->status == 1)
                                <span class="badge badge-success">Active</span>
                            @elseif($project->status ==0)
                                <span class="badge badge-danger">In-Active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('project.edit', $project->id)}}" class="btn btn-primary" title="Edit Project"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$project->id}}" title="Delete Project"><i class="fa fa-trash"></i></a>

                            <!-- The Modal -->
                            <div class="modal" id="delete{{$project->id}}">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <form method="post" action="{{route('project.destroy', $project->id)}}">
                                        @method('DELETE')
                                        {{@csrf_field()}}
                                        <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title"><i class="fa fa-trash-o"></i> Delete Confirmation!</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Are you sure to remove this record?
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </table>

        </div>
    </div>

@stop