<?php

namespace App\Actions\Fortify;
use App\Http\Requests\RegisterRequest;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    'password_confirmation' => ['required'],
])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

    public function __invoke(array $input)
{
    // RegisterRequest を使って手動バリデーション
    $request = new RegisterRequest();
    $request->merge($input); // 配列をRequestに変換

    $validator = \Validator::make($request->all(), $request->rules(), $request->messages());
    if ($validator->fails()) {
        throw new \Illuminate\Validation\ValidationException($validator);
    }

    return User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ]);
}
}
