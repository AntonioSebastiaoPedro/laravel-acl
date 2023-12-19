<?php

namespace App\Http\Controllers;

use App\DTOs\Users\CreateUserDTO;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    
    public function __construct(private UserRepository $userRepository)
    {
        
    }

    public function index(Request $request)
    {
        $users =  $this->userRepository->getPaginate(
            totalPerPage: $request->total_per_page ?? 15,
            page: $request->page ?? 1,
            filter: $request->filter ?? ''
        );

        return UserResource::collection($users);
    }

    
    public function store(Request $request)
    {
        $user = $this->userRepository->createNew(New CreateUserDTO(
            $request->name,
            $request->email,
            $request->password,
        ));
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
