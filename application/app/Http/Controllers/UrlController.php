<?php

namespace App\Http\Controllers;

use App\Actions\Urls\CreateUrlAction;
use App\Actions\Urls\RedirectToUrlAction;
use App\Http\Requests\ShowUrlRequest;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $urls = Url::query()->orderByDesc('id')->paginate(10);

        return view('url_shortening.main', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(StoreUrlRequest $request, CreateUrlAction $createUrlAction): UrlResource
    {
        $url = $createUrlAction->handle($request->toDTO());

        return UrlResource::make($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUrlRequest $request, Url $url, RedirectToUrlAction $redirectUrlAction): RedirectResponse
    {
        $redirectLink = $redirectUrlAction->handle($request->toDTO());

        return redirect($redirectLink);
    }
}
