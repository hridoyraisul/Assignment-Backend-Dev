<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddJobRequest;
use App\Http\Requests\ApplyJobRequest;
use App\Interfaces\JobInterface;
use App\Models\Applicants;
use App\Models\JobSchema;
use App\Models\JobType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $JobRepo;
    public function __construct(JobInterface $jobInterface)
    {
        $this->JobRepo = $jobInterface;
    }


    //API----------------------------------------------------
    public function getAllActiveJob(): JsonResponse
    {
        $jobs = $this->JobRepo->allActiveJobs();
        return response()->json($jobs,200);
    }
    public function singleJobView($job_id): JsonResponse
    {
        $job = $this->JobRepo->viewJob($job_id);
        return response()->json($job,200);
    }
    public function applyJob(ApplyJobRequest $request): JsonResponse
    {
        $this->JobRepo->applyJob($request);
        return response()->json(['status'=>'success'],201);
    }


    //WEB----------------------------------------------------
    public function addJobPage()
    {
        $jobTypes = JobType::all();
        return view('pages.addJob',compact('jobTypes'));
    }
    public function addJobType(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->JobRepo->createJobType($request);
        return redirect()->back()->with(['job_type_success' => 'Successfully added new job type!']);
    }
    public function addNewJob(AddJobRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->JobRepo->createJob($request);
        return redirect()->back()->with(['job_create_success' => 'Successfully added new job!']);
    }
    public function jobListPage()
    {
        $jobs = JobSchema::all();
        return view('pages.jobList',compact('jobs'));
    }
    public function changeJobStatus($slug,$status): \Illuminate\Http\RedirectResponse
    {
        $this->JobRepo->changeStatus($slug,$status);
        return redirect()->back()->with(['change_success' => 'Job status changed']);
    }
    public function viewJob($job_id)
    {
        $job = JobSchema::find($job_id);
        $jobTypes = JobType::all();
        return view('pages.viewJob',compact('job','jobTypes'));
    }
    public function updateJob(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->JobRepo->updateJob($request);
        return redirect()->back()->with(['job_update_success' => 'Successfully updated job information']);
    }
    public function applicantList()
    {
        $applicants = $this->JobRepo->allApplicants();
        return view('pages.applicantList',compact('applicants'));
    }
    public function coverLetterView($applicant_id): JsonResponse
    {
        $coverLetter = Applicants::find($applicant_id)->cover_letter;
        return response()->json($coverLetter,200);
    }
    public function downloadResume($file): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $data = '/uploads/resumes/';
        return response()->download(public_path($data.$file));
    }
}
