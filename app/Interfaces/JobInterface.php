<?php
namespace App\Interfaces;

interface JobInterface
{
    public function createJob(array $data);
    public function viewJob($job_id);
    public function updateJob($job_id,array $data);
    public function deactivateJob($job_id);
    public function activateJob($job_id);
}
