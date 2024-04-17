<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/users/list",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getUserByLists(Request $request)
    {
        // Check if the 'page' parameter is provided in the request
        if ($request->has('page')) {
            $currentPage = $request->query('page', 1);
            $perPage = 10;
            $offset = ($currentPage - 1) * $perPage;
            $users = User::skip($offset)->take($perPage)->get();

            return response()->json($users);
        } else {
            $users = User::all();
            return response()->json($users);
        }
    }


    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Get user detail by id",
     *     tags={"Users"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function getUserById(User $user)
    {
        return response()->json($user);
    }

    public function createUser(Request $request)
    {
        $userDTO = new UserDTO(
            $request->input('name'),
            $request->input('department_id'),
        );

        $user = $this->userService->createUser($userDTO);

        return response()->json($user);
    }

    public function updateUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $userDTO = new UserDTO(
            $request->input('name'),
            $request->input('department_id')
        );

        $user->name = $userDTO->getName();
        $user->department_id = $userDTO->getDepartmentId();

        $user->save();

        return response()->json($user);
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);

        $user->delete();

        return response();
    }
}
