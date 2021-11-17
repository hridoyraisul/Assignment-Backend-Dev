<?php
namespace App\Interfaces;

interface JobInterface
{
    public function createJob($data);
    public function createJobType($data);
    public function applyJob($data);
    public function allApplicants();
    public function allActiveJobs();
    public function viewJob($job_id);
    public function changeStatus($job_slug,$status);
    public function updateJob($data);
}
