<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\TrainerAlreadyExisits;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\Trainer;
use App\Providers\RouteServiceProvider;
use App\Repositories\TrainerRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    private TrainerRepository $trainerRepository;

    public function __construct(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisteredUserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function store(RegisteredUserRequest $request)
    {
        //validation already done by RegisteredUserRequest
        $trainer = $this->trainerRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'region' => $request->region,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($trainer));

        Auth::login($trainer);

        return redirect(RouteServiceProvider::HOME);
    }
}
