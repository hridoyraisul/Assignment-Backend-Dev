@extends('main')
@section('body')
    <main class="app-content">
        @if(session()->has('job_update_success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{session('job_update_success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Update Job</h3>
                <div class="tile-body">
                    <form class="form-horizontal" method="post" action="{{route('update.job')}}" enctype="multipart/form-data">@csrf
                        <div class="form-group row">
                            <label class="control-label col-md-3">Title</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" name="title" value="{{$job->title}}" placeholder="Enter job title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Job Type</label>
                            <div class="col-md-8">
                                <select name="job_types_id" class="form-control col-md-8">
                                    <option disabled>Select job type</option>
                                    @forelse($jobTypes as $jobType)
                                        <option value="{{$jobType->id}}" @if($jobType->id === $job->job_types_id) selected @endif>{{$jobType->title}}</option>
                                    @empty
                                        <option>No job type added yet</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="description" placeholder="Enter job description">{{$job->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Thumbnail</label>
                            <div class="col-md-8">
                                <img src="{{asset('uploads/thumbnails/'.$job->thumbnail)}}" height="60px">
                            </div>
                        </div>
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
