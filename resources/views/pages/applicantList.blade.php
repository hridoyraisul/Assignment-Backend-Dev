@extends('main')
@section('body')
    <main class="app-content">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">All Applicants</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Job Title</th>
                        <th>View Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applicants as $key => $applicant)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$applicant->userInfo->name}}</td>
                            <td>
                                Phone: {{$applicant->userInfo->phone}}<br>
                                Email: {{$applicant->userInfo->email}}
                            </td>
                            <td> {{$applicant->jobInfo->title}}</td>
                            <td>
                                <a id="viewBtn" data-applicant="{{$applicant->id}}" style="color: white" class="btn btn-sm btn-dark">View Cover Letter</a>
                                <a href="{{url('/resume-download/'.$applicant->resume)}}" class="btn btn-sm btn-info">Download Resume</a>
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
    <!-- Modal -->
    <div class="modal fade" id="applicantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #0f6674">Cover Letter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '#viewBtn', function(e) {
            e.preventDefault();
            let applicant = $(this).data('applicant');
            $.ajax({
                url: "/cover-letter/"+applicant,
                type: "GET",
                dataType: 'html',
                success:function (response){
                    const data = JSON.parse(response);
                    $('.modal-body').html(data);
                    jQuery("#applicantModal").modal('toggle');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@endsection
