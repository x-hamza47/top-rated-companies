<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InsightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Start the query with eager loading
        $query = Insight::with(['service:id,name', 'user:id,firstName,lastName,email,profile_image'])
            ->latest();


        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // Paginate the results
        $insights = $query->paginate(10);

        return view('dashboard.insights.list', compact('insights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        return view('dashboard.insights.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:insights,slug',
            'description' => 'nullable|string',
            'article' => 'required|string',
        ]);

        $data['user_id'] = $user_id;

        Insight::create($data);
        return redirect()->route('insights.index')->with('success', 'Insight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insight $insight)
    {
        // fixme: Convert these into policies 
        if (Gate::denies('admin') && $insight->user_id != Auth::id()) {
            abort(403, 'You are not allowed to edit this insight.');
        }
        $services = Service::pluck('name', 'id');
        return view('dashboard.insights.edit', compact('insight', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insight $insight)
    { // fixme: Convert these into policies 
        if (Gate::denies('admin') && $insight->user_id != Auth::id()) {
            abort(403, 'You are not allowed to edit this insight.');
        }

        $data = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|unique:insights,slug,' . $insight->id,
            'description' => 'nullable|string',
            'article'    => 'required|string',
        ]);

        $insight->update($data);
        return redirect()->route('insights.index')->with('success', 'Insight updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insight $insight)
    { // fixme: Convert these into policies 
        if (Gate::denies('admin') && $insight->user_id != Auth::id()) {
            abort(403, 'You are not allowed to delete this insight.');
        }

        $insight->delete();

        return redirect()->route('insights.index')->with('success', 'Insight deleted successfully.');
    }
}
