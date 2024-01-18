<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if (!$request->user()->admin) {
            return redirect()->route('dashboard.index')
                ->withError('Sorry, you are not allowed to do that.');
        }

        $users = User::where('company_id', $request->user()->company->id)
            ->where('admin', false)
            ->latest()
            ->get();

        return view('users.index', compact('users'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['company_id'] = $request->user()->company->id;

        $password = Str::random(15);

        $validated['password'] = Hash::make($password);

        if (User::create($validated)) {
            return redirect()->route('users.index')
                ->withSuccess('The user has been added successfully.');
        }

        return redirect()->route('users.index')
                ->withError('There was an error. The user hasn\'t been added. Please try again.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if (!$request->user()->admin || $user->company_id !== $request->user()->company_id) {
            return redirect()->route('users.index')
                ->withError('Sorry, you are not allowed to do that.');
        }

        if ($user->delete()) {
            return redirect()->route('users.index')
                ->withSuccess('The user has been deleted successfully.');
        }

        return redirect()->route('users.index')
                ->withError('There was an error. The user hasn\'t been deleted. Please try again.');
    }
}
