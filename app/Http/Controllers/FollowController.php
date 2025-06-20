<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Follow;
use App\Http\Resources\FollowResource;
use App\Http\Requests\Follow\StoreFollowRequest;
use App\Http\Requests\Follow\UpdateFollowRequest;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $follows = Follow::with(['follower', 'following'])->paginate($limit);
        return response()->json([
            'data' => FollowResource::collection($follows),
            'meta' => [
                'current_page' => $follows->currentPage(),
                'last_page' => $follows->lastPage(),
                'per_page' => $follows->perPage(),
                'total' => $follows->total(),
                'from' => $follows->firstItem(),
                'to' => $follows->lastItem(),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFollowRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Override follower_id with authenticated user's ID for security
        $validated['follower_id'] = auth()->id();

        // The validation rules in StoreFollowRequest already handle:
        // - Checking if users exist
        // - Preventing self-follows
        // - Preventing duplicate follows

        $follow = Follow::create($validated);

        return response()->json(new FollowResource($follow), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $follow = Follow::with(['follower', 'following'])->findOrFail($id);
        return response()->json(new FollowResource($follow), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFollowRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $validated['follower_id'] = auth()->id();

        $follow = Follow::findOrFail($id);

        // The validation rules in UpdateFollowRequest already handle:
        // - Checking if users exist
        // - Preventing self-follows
        // - Preventing duplicate follows

        $follow->update($validated);

        return response()->json(new FollowResource($follow), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $follow = Follow::findOrFail($id);
        $follow->delete();

        return response()->json(null, 204);
    }

    public function checkIfFollowing(Request $request): JsonResponse
    {
        $validated = $request->validate([
          'following_id' => 'required|exists:users,id',
        ]);

        $follower_id = auth()->id();

        $follow = Follow::where('follower_id', $follower_id)
            ->where('following_id', $validated['following_id'])
            ->first();

        if ($follow) {
            return response()->json(['following' => true, 'follow_id' => $follow->following_id]);
        } else {
            return response()->json(['following' => false, 'follow_id' => null]);
        }
    }

    // get number of followers and following for a user
    public function getFollowers(Request $request, string $userId): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        $followers = Follow::where('following_id', $userId)
            ->with('follower')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
          'data' => FollowResource::collection($followers),
          'meta' => [
            'current_page' => $followers->currentPage(),
            'last_page' => $followers->lastPage(),
            'per_page' => $followers->perPage(),
            'total' => $followers->total(),
            'from' => $followers->firstItem(),
            'to' => $followers->lastItem(),
          ],
        ]);
    }
    public function getFollowing(Request $request, string $userId): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

        if (!$userId) {
            return response()->json(['message' => 'User ID is required'], 400);
        }

        $following = Follow::where('follower_id', $userId)
            ->with('following')
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json([
          'data' => FollowResource::collection($following),
          'meta' => [
            'current_page' => $following->currentPage(),
            'last_page' => $following->lastPage(),
            'per_page' => $following->perPage(),
            'total' => $following->total(),
            'from' => $following->firstItem(),
            'to' => $following->lastItem(),
          ],
        ]);
    }
}
