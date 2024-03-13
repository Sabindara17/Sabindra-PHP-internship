<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
// use App\Models\User;
// use Illuminate\Support\Facades\auth;


class APIController extends Controller
{
    /*
     * @OA\Get(
     *      path="/api/post",
     *      operationId="getPostDetails",
     *      tags={"Post"},
     *      summary="Get post details",
     *      description="Returns detail of post",
     *      security={{"bearer_token":{}}},
     *      @OA\Response(response=200, description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="resCod", type="string", example="200"),
     *                  @OA\Property(property="resDesc", type="string", example="Post details"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Error in input"
     *         ),
     *       @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *       ),
     *       @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *       ),
     * )
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['status' => 200, 'message' => $posts]);
    }
    public function store(Request $request)
    {
        if (is_null($request->title)) {
            return response()->json(['message' => 'Title is required']);
        }
        try {
            Post::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return response()->json(['status' => 200, 'message' => 'Post created successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'message' => 'Something went wrong']);
        }
    }
    public function update(Request $request, $id)
    {
        if (is_null($request->title)) {
            return response()->json(['message' => 'Title is required']);
        }
        try {
            $post = Post::find($id);
            if (is_null($post)) {
                return response()->json(['message' => 'Post not found']);
            }
            $post->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return response()->json(['status' => 200, 'message' => 'Post updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'message' => 'Something went wrong']);
        }
    }
    public function destroy($id)
    {
        try {
            $post = Post::find($id);

            if (is_null($post)) {
                return response()->json(['message' => 'Post not found']);
            }

            $post->delete();

            return response()->json(['status' => 200, 'message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'message' => 'Something went wrong']);
        }
    }
}
