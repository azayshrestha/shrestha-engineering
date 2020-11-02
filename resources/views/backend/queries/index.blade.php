@extends('backend.includes.layout')

@section('title')
    Queries
@stop

@section('formHeader')
    Queries
@stop

@section('formSubHeader')

@stop

@section('style')

@stop

@section('script')

@stop

@section('content')
    <div class="card">
        <div class="card-body">
        <table class="table" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Mail From</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($queries as $key=>$query)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        {{$query->name}}<br>
                        {{$query->email}}
                    </td>
                    <td>
                        <b>Subject: {{$query->subject}}</b><br>
                        {{substr(strip_tags($query->message),0, 1000)}}
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$query->id}}" title="Delete User"><i class="fa fa-trash"></i></a>
                    </td>

                    <div class="modal" id="delete{{$query->id}}">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <form method="post" action="{{route('query.destroy', $query->id)}}">
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
            {{$queries->links()}}
    </div>


@stop