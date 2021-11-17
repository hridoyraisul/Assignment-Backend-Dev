@extends('main')
@section('body')
    <main class="app-content">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">All Posted Jobs</h3>
                @if(session()->has('change_success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{session('change_success')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Job title</th>
                        <th>Job Type</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($jobs as $key => $job)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$job->title}}</td>
                            <td>{{$job->jobType->title}}</td>
                            <td><img src="{{asset('uploads/thumbnails/'.$job->thumbnail)}}" height="40px"></td>
                            <td>{{$job->status}}</td>
                            <td>
                                @if($job->status === 'active')
                                    <a href="{{route('change.status', ['slug'=>$job->slug, 'status'=>'inactive'])}}" class="btn btn-sm btn-danger">Deactivate</a>
                                @else
                                    <a href="{{route('change.status', ['slug'=>$job->slug, 'status'=>'active'])}}"  class="btn btn-sm btn-info">Activate</a>
                                @endif
                                <a href="{{route('view.job',['job_id' => $job->id])}}" class="btn btn-sm btn-dark">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <h5>No jobs available</h5>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </main>

@endsection
