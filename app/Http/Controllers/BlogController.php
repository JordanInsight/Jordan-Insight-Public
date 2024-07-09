<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\ImageService;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use URL;

class BlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::with('user')->latest('updated_at')->paginate(3);
        return view('base.blog.index', compact('posts', 'user'));
    }

    public function fetch()
    {
        $posts = Post::with('user')
            ->withCount(['comments', 'likes'])
            ->latest('updated_at')
            ->paginate(5);



        return response()->json([
            'posts' => $posts->items(),
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'perPage' => $posts->perPage(),
            'total' => $posts->total(),
            'previousPageUrl' => $posts->previousPageUrl(),
            'nextPageUrl' => $posts->nextPageUrl() ? URL::to($posts->nextPageUrl()) : null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // Max file size 2MB
        ]);

        $data = $request->only(['title', 'content']);
        $data['user_id'] = Auth::id();
        $data['post_date'] = Carbon::now();

        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadImage('post_images', $request->file('image'));
            $data['image'] = $imageName;
        }

        $post = Post::create($data);

        return response()->json(['message' => 'Post Added Successfully', 'post' => $post]);
    }

    public function postSearch(Request $request)
    {
        $query = $request->input('query');
        $terms = explode(' ', $query);  // Split the search query into individual terms

        $posts = Post::query();

        // First apply search terms to posts' title and content
        foreach ($terms as $term) {
            $posts->orWhere('title', 'like', "%{$term}%")
                ->orWhere('content', 'like', "%{$term}%");
        }

        // Then apply search terms to associated user details
        foreach ($terms as $term) {
            $posts->orWhereHas('user', function ($q) use ($term) {
                $q->where('first_name', 'like', "%{$term}%")
                    ->orWhere('last_name', 'like', "%{$term}%");
            });
        }

        $posts = $posts->with('user')
            ->withCount(['comments', 'likes'])
            ->latest('updated_at')
            ->paginate(5);

        return response()->json([
            'posts' => $posts->items(),
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'total' => $posts->total(),
            'previousPageUrl' => $posts->previousPageUrl(),
            'nextPageUrl' => $posts->nextPageUrl() ? URL::to($posts->nextPageUrl()) : null,
        ]);
    }




    public function postDetails($id)
    {
        $post = Post::with(['user', 'comments.user', 'likes'])
            ->withCount(['comments', 'likes'])
            ->findOrFail($id);



        $post->formatted_content = collect(explode("\n\n", $post->content))
            ->map(function ($paragraph) {
                return "<p>" . e($paragraph) . "</p>";
            })
            ->implode('');

        return view('base.blog.post-details', compact('post'));
    }



    public function fetchPostDetails($id)
    {
        try {
            $post = Post::with(['user', 'comments.user', 'comments.likes'])
                ->withCount([
                    'comments',
                    'likes'  // Directly count all likes associated with the post
                ])
                ->findOrFail($id);

            $post->content = html_entity_decode($post->content);
            $userHasLikedPost = $post->likes->contains('user_id', auth()->id());

            $commentsData = $post->comments->map(function ($comment) {
                $comment->likes_count = $comment->likes->count();
                $comment->user_has_liked = $comment->likes->contains('user_id', auth()->id());
                return $comment;
            });

            // Generate the profile link using the user ID associated with the post
            $profileLink = route('user.profile', ['user' => $post->user->id]);

            return response()->json([
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'image' => $post->image,
                'likes_count' => $post->likes->count(),  // Directly use count of likes
                'comments_count' => $post->comments_count,
                'user' => $post->user,
                'comments' => $commentsData,
                'user_has_liked' => $userHasLikedPost,
                'profileLink' => $profileLink
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }





    public function fetchRecentPosts()
    {
        $recentPosts = Post::with(['user'])  // Ensure 'user' relationship is correctly set up
            ->latest('updated_at')
            ->take(3)
            ->get();

        return response()->json($recentPosts);
    }



    public function storeComment(Request $request, $postId)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255', // Ensure the field name matches your AJAX data
        ]);

        // Ensure the user is logged in before allowing them to comment
        if (!auth()->check()) {
            return response()->json(['logged_in' => false, 'message' => 'Please log in to comment.']);
        }

        $comment = new Comment([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'content' => $validated['message'],
            'created_at' => now(),
            'updated_at' => now(), // You may also want to set updated_at if your table requires it
        ]);

        $comment->save();

        // Prepare the user data to return for updating the UI
        return response()->json([
            'logged_in' => true,
            'user_profile' => auth()->user()->user_pfp, // Assuming user profile picture is named user_pfp
            'user_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'comment' => $comment->content,
            'comment_id' => $comment->id,
            'message' => 'Comment added successfully!'
        ]);
    }


    public function updateComment(Request $request, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update($validated);

        return response()->json(['message' => 'Comment updated successfully']);
    }

    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    private $imageService; // Create a private variable for the ImageService

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService; // Initialize the ImageService
    }


    public function updatePost(Request $request)
    {
        $validated = $request->validate([
            'postId' => 'required|exists:posts,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Max file size 2MB
        ]);

        $post = Post::findOrFail($validated['postId']);
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        // Check if a request to remove the image was made
        if ($request->has('removeImage') && $request->input('removeImage') == 'true') {
            // Delete the old image file if it exists
            if ($post->image) {
                $this->imageService->deleteImage('post_images', $post->image);
            }
            $post->image = null; // Set the image field to null
            $post->save();
        } elseif ($request->hasFile('image')) {
            // Handle image upload if a new image is provided
            $imageName = $this->imageService->uploadImage('post_images', $request->file('image'));
            // Delete the old image if it exists
            if ($post->image) {
                $this->imageService->deleteImage('post_images', $post->image);
            }
            $post->image = $imageName;
            $post->save();
        }

        return response()->json(['message' => 'Post updated successfully']);
    }



    public function deletePost(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }


    public function toggleLike($postId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Not logged in'], 403);
        }

        $post = Post::findOrFail($postId);
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();  // User unlikes the post
            $isLiked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);  // User likes the post
            $isLiked = true;
        }

        return response()->json([
            'likes_count' => $post->likes()->count(),  // Count only likes for posts if necessary
            'user_has_liked' => $isLiked
        ]);
    }


    public function toggleCommentLike(Post $post, Comment $comment)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Not logged in'], 403);
        }

        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();  // User unlikes the comment
            $isLiked = false;
        } else {
            // User likes the comment, ensure post_id is also included
            $comment->likes()->create([
                'user_id' => $user->id,
            ]);
            $isLiked = true;
        }

        return response()->json([
            'likesCount' => $comment->likes()->count(),
            'userHasLiked' => $isLiked
        ]);
    }
}
