<?php
namespace App\Repositories;
use App\Interfaces\JobInterface;
use App\Models\Applicants;
use App\Models\JobSchema;
use App\Models\JobType;
use App\Traits\JobControlTrait;
use Illuminate\Support\Str;

class JobRepository implements JobInterface
{
    use JobControlTrait;
    public function createJob($data)
    {
        $thumbnail = null;
        if ($data->hasFile('thumbnail'))
        {
            $thumbnail = Str::random(10).time().'.'.$data->file('thumbnail')->extension();
            $this->uploadFile('uploads/thumbnails/',$data->file('thumbnail'),$thumbnail);
        }
        return JobSchema::create([
            'title' => $data->title,
            'job_types_id' => $data->job_types_id,
            'description' => $data->description,
            'thumbnail' => $thumbnail
        ]);
    }

    public function applyJob($data)
    {
        $resume = null;
        if ($data->hasFile('resume'))
        {
            $resume = Str::random(10).time().'.'.$data->file('resume')->extension();
            $this->uploadFile('uploads/resumes/',$data->file('resume'),$resume);
        }
        return Applicants::create([
            'user_id' => $data->user_id,
            'job_schema_id' => $data->job_id,
            'cover_letter' => $data->cover_letter,
            'resume' => $resume
        ]);
    }

    public function allApplicants()
    {
        return Applicants::all();
    }

    public function createJobType($data)
    {
        return JobType::create([
            'title' => $data->title
        ]);
    }

    public function allActiveJobs()
    {
        return JobSchema::join('job_types','job_schemas.job_types_id','job_types.id')
            ->where('job_schemas.status','active')
            ->select(
                'job_schemas.id',
                'job_schemas.title as job_title',
                'job_types.title as job_type',
                'job_schemas.thumbnail'
            )->get();
    }

    public function viewJob($job_id)
    {
        return JobSchema::join('job_types','job_schemas.job_types_id','job_types.id')
            ->where('job_schemas.id',$job_id)
            ->first([
                'job_schemas.id',
                'job_schemas.title as job_title',
                'job_types.title as job_type',
                'job_schemas.thumbnail',
                'job_schemas.description'
            ]);
    }

    public function changeStatus($job_slug,$status)
    {
        return JobSchema::where('slug',$job_slug)->update(['status' => $status]);
    }


    public function updateJob($data)
    {
        return JobSchema::where('id',$data->job_id)->update([
            'title' => $data->title,
            'job_types_id' => $data->job_types_id,
            'description' => $data->description,
        ]);
    }
}
