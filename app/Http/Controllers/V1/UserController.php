<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Notifications\NewUserNotification;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function store(Request $request)
	{

		$request->validate([
			'dni' => 'required|numeric|unique:users',
			'first_name' => 'required|string|max:100|min:5',
			'last_name' => 'required|string|max:100|min:5',
			'email' => 'required|string|email|max:150|unique:users',
			'address' => 'required|string|max:180',
			'cell_phone' => 'required|numeric|min:10',
			'country' => 'required|string',
			'category_id' => 'required|numeric',
		]);

		$data = $request->json()->all();

		$userExist = User::where('dni', '=', $data['dni'])
			->orWhere('email', '=', $data['email'])
			->first();

		if ($userExist) {
			return response()->json([
				'message' => 'User already exist'
			], 409);
		}

		$user = User::create([
			'dni' => $data['dni'],
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'address' => $data['address'],
			'cell_phone' => $data['cell_phone'],
			'country' => $data['country'],
			'category_id' => $data['category_id'],
		]);

		// Send notification to user
		$user->notify(new WelcomeEmailNotification());
		$usersReport = $this->getUsersReport();

		// Send report to admin
		Notification::route('mail', env('ADMIN_MAIL_ADDRESS', 'jefferyth@gmail.com'))->notify(new NewUserNotification($usersReport));

		return response()->json(new UserResource($user), 201);
	}

	private function getUsersReport()
	{
		return User::select('country', DB::raw('count(*) as total'))
			->groupBy('country')
			->get();
	}
}
