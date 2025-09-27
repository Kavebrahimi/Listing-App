<?php

namespace App\Http\Controllers;

use App\Http\Middleware\NotSuspendedMiddleware;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListingController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(['auth', 'verified', NotSuspendedMiddleware::class], 
                except: ['index', 'show'])
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listings = Listing::whereHas('user', function (Builder $query){
            $query->where('role', '!=', 'suspended');
        })
            ->with('user')
            ->where('approved', true)
            ->filter($request->only('search', 'user_id', 'tag'))
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return Inertia::render('Home', [
            'listings' => $listings,
            'searchTerm'=>$request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Listing::class);
        
        return Inertia::render('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Listing::class);
        
        $fields = $request->validate([
           'title'=> ['required', 'max:255'],
           'desc'=> ['required'],
           'tags'=> ['string', 'nullable'],
           'email'=> ['email', 'nullable'],
           'link'=> ['url', 'nullable'],
           'image'=> ['image', 'nullable', 'max:3072', 'mimes:jpeg,png,jpg'],
        ]);

        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put('images/listings', $request->image);
        }

        $fields['tags'] = implode(
            ',', array_unique(
                array_filter(
                    array_map(
                        'trim', explode(',', $request->tags
                        )
                    )
                )
            )
        );

        $request->user()->listings()->create($fields);
        return redirect()->route('dashboard')
            ->with('status', 'درخواست شما با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        Gate::authorize('view', $listing);
         
        return Inertia::render('Listing/Show', [
            'listing'=>$listing,
            'user'=>$listing->user->only(['full_name', 'id']),
            'canModify'=> Auth::user() ? Auth::user()->can('modify', $listing) : false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        Gate::authorize('modify', $listing);
        
        return Inertia::render('Listing/Edit',[
            'listing'=>$listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        Gate::authorize('modify', $listing);
        
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'desc' => ['required'],
            'tags' => ['string', 'nullable'],
            'email' => ['email', 'nullable'],
            'link' => ['url', 'nullable'],
            'image' => ['image', 'nullable', 'max:3072', 'mimes:jpeg,png,jpg'],
        ]);

        if ($request->hasFile('image')) {

            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $fields['image'] = Storage::disk('public')->put('images/listings', $request->image);
        } else {
            $fields['image'] = $listing->image;
        }
            $fields['tags'] = implode(
                ',', array_unique(
                    array_filter(
                        array_map(
                            'trim', explode(',', $request->tags
                            )
                        )
                    )
                )
            );

            $listing->update([...$fields, 'approved'=>false]);

            return redirect()->route('dashboard')
                ->with('status', 'درخواست شما با موفقیت بروزرسانی شد');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        Gate::authorize('modify', $listing);
        
        if ($listing->image) {
            Storage::disk('public')->delete($listing->image);
        }
        
        $listing->delete();
        return redirect()->route('dashboard')
            ->with('status', 'درخواست شما با موفقیت حذف شد');
    }
}
