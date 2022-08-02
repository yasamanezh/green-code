<?php

namespace App\Actions\Fortify;

use App\Jobs\DefaultNotification;
use App\Models\Notification;
use App\Models\SiteOption;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Trez\RayganSms\Facades\RayganSms;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'digits:11', 'unique:users,phone'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user=User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);
        DefaultNotification::dispatch($user,'register');
        $admins=User::where('role','admin')->get();
        foreach($admins as $admin){
            Notification::create([
                'user_id' => $admin->id,
                'type'=>'register',
                'link'=>$admin->id
            ]);
            DefaultNotification::dispatch($admin,'register_admin');
        }
      return $user;

      }
}
