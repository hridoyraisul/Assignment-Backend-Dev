<?php
namespace App\Repositories;
use App\Interfaces\UserInterface;
use App\Models\Applicants;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    public function authenticate($data)
    {
        // TODO: Implement authenticate() method.
    }

    public function signUpUser($data)
    {
        return User::create([
            'name' => $data->name,
            'phone'=> $data->phone,
            'email'=> $data->email,
            'password' => Hash::make($data->password)
        ]);
    }

    public function viewUser($user_id)
    {
        return User::join('applicants', 'users.id','applicants.user_id')
            ->join('job_schemas','applicants.job_schema_id','job_schemas.id')
            ->where('users.id',$user_id)
            ->first([
                'users.*',
                'applicants.cover_letter',
                'applicants.resume',
                'job_schemas.title'
            ]);
    }
    public function allApplicants()
    {
        return Applicants::join('users','applicants.user_id','users.id')
            ->select(
                'users.*',
                'applicants.cover_letter',
                'applicants.resume'
            )->get();
    }
}
