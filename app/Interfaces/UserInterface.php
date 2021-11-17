<?php
namespace App\Interfaces;

interface UserInterface
{
    public function authenticate($data);
    public function signUpUser($data);
    public function viewUser($user_id);
    public function allApplicants();
}
