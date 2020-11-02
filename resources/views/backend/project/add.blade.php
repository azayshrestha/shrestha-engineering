@extends('backend.includes.layout')

@section('title')
    About
@stop

@section('formHeader')
    @if(!$project) Add @else Update @endif Project
@stop

@section('formSubHeader')

@stop

@section('style')
    <link rel="stylesheet" href="{{asset('css/image-uploader.min.css')}}">
@stop

@section('script')
<script src="{{asset('js/image-uploader.min.js')}}"></script>
<script>
    $(document).ready(function () {
        icon();
        function icon(){
            $('.iui-cloud-upload').removeClass('iui-cloud-upload').addClass('fas fa-cloud-upload-alt');
            $('.iui-close').removeClass('iui-close').addClass('fas fa-times');
        }
        $('.input-images input[type="file"]').change(function () {
            icon();
        })
    });
    var url = '/images/projectImage/'
    @if($project)
        var array = @php echo json_encode($project->images); @endphp;
        let preloaded = [];


        // Display the array elements
        for(var i = 0; i < array.length; i++){
            let obj = {
                "id": array[i].id,
                "src": url + array[i].image
            }
            preloaded.push(obj)
        }

        $('.input-images').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'images',
            preloadedInputName: 'oldImages',
            label: 'Drag & Drop Images here or click to browse'
        });
    @else
        $('.input-images').imageUploader({
            label: 'Drag & Drop Images here or click to browse'
        });
    @endif
</script>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @if($project)
                <form method="post" action="{{route('project.update', $project->id)}}" enctype="multipart/form-data">
                 <input type="hidden" name="_method" value="PUT">
            @else
                <form method="post" action="{{route('project.store')}}" enctype="multipart/form-data">
            @endif
                    {{@csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Project Title</label>
                                        <input type="text" class="form-control" name="title"  value="@if(!$project) {{old('title')}} @else {{$project->title}} @endif" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Service Type</label>
                                        <select class="form-control" name="service">
                                            <option value="" selected>Select Service Type</option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" @if($project && $project->service_id == $service->id) selected @endif>{{$service->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label>Description</label>
                            @if($project)
                                <textarea class="textarea w-100" name="description">{{$project->description}}</textarea>
                            @else
                                <textarea class="textarea w-100" name="description">{{old('description')}}</textarea>
                            @endif
                            <div class="form-group">
                                <label>Status <span class="red">*</span></label> <br>
                                <label>
                                    <input type="radio" name="status" value="1" class="mr-2"
                                      @if(!$project)
                                      checked
                                      @else
                                      @if($project->status == 1) checked @endif
                                      @endif required> Active</label>
                                <label class="ml-3"><input type="radio" name="status" value="0" class="mr-2"  @if($project && $project->status == 0) checked @endif required> In-Active</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <label class="active">Project Images</label>
                                <div class="input-images" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-outline-info">
                    @if(!$project) Submit @else Update @endif
                </button>
            </form>
        </div>
    </div>
@stop
