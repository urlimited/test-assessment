<?php

namespace App\Http\Controllers;

use App\Actions\Urls\CreateUrlAction;
use App\Actions\Urls\RedirectToUrlAction;
use App\Http\Requests\ShowUrlRequest;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use App\Models\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $urls = Url::query()->paginate(10);

        return view('url_shortening.main', compact('urls'));
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
    public function store(StoreUrlRequest $request, CreateUrlAction $createUrlAction)
    {
        $createUrlAction->handle($request->toDTO());
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUrlRequest $request, Url $url, RedirectToUrlAction $redirectUrlAction): RedirectResponse
    {
        $redirectLink = $redirectUrlAction->handle($request->toDTO());

        return redirect($redirectLink);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        //
    }
}
