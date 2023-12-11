<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return Inertia::render('User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::create(
            Request::validate([
                'title' => ['required', 'max:90'],
                'description' => ['required'],
            ])
        );

        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Post/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = Request::validate([
                'title' => ['required', 'max:90'],
                'description' => ['required'],
            ]);
        $post->update($data);


        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::route('posts.index');
    }

    public function dataTable()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('first_name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(User::class)
        ->defaultSort('first_name')
        ->allowedSorts(['first_name', 'email'])
        ->allowedFilters(['first_name', 'email', $globalSearch])
        ->paginate(8)
        ->withQueryString();

        return Inertia::render('User/User-dt', ['users' => $users])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: true, sortable: true);
            $table->column('first_name', 'User Name', searchable: true, sortable: true);
            $table->column('email', 'Email Address', searchable: true, sortable: true);
            $table->column('created_at', 'Join Date', searchable: true, sortable: true);
        });
    }
}
