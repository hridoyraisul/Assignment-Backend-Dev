@extends('main')
@section('body')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Add Job Openings</h1>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Woops!</strong>  An error occurred! Try again please.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                @if(session()->has('job_type_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Great!</strong> {{session('job_type_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="tile">
                    <form method="post" action="{{route('add.job.type')}}">@csrf
                    <h3 class="tile-title">Add Job Type</h3>
                    <div class="tile-body">
                            <div class="form-group">
{{--                                <label class="control-label">Title</label>--}}
                                <input class="form-control" name="title" type="text" placeholder="Enter Job-type title">
                            </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                @if(session()->has('job_create_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Great!</strong> {{session('job_create_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="tile">
                    <h3 class="tile-title">Add New Job</h3>
                    <div class="tile-body">
                        <form class="form-horizontal" method="post" action="{{route('add.job')}}" enctype="multipart/form-data">@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="title" placeholder="Enter job title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Job Type</label>
                                <div class="col-md-8">
                                    <select name="job_types_id" class="form-control col-md-8">
                                        <option selected disabled>Select job type</option>
                                        @forelse($jobTypes as $jobType)
                                            <option value="{{$jobType->id}}">{{$jobType->title}}</option>
                                        @empty
                                            <option>No job type added yet</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="4" name="description" placeholder="Enter job description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Thumbnail</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="thumbnail" id="exampleInputFile" type="file" aria-describedby="fileHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearix"></div>
        </div>
    </main>
@endsection
