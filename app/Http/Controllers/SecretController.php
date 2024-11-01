<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecretCreateRequest;
use App\Models\Secret;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class SecretController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return redirect()->route('secrets.create');
    }

    public function create()
    {
        return view('secrets.create');
    }

    public function store(SecretCreateRequest $request)
    {

        $validatedData = $request->validated();
        $expiresAt = now('UTC')->addHours((int)$validatedData['expires_in']);
        $token = Str::random(60) . '$' . Str::uuid();

        Secret::create([
            ...$validatedData,
            'expires_at' => $expiresAt,
            'token' => $token
        ]);

        return view('secrets.link', [
            'link' => URL::temporarySignedRoute('secrets.show', $expiresAt, ['secret' => $token]),
            'expires_in' => $expiresAt->diffForHumans(),
            'max_views' => $validatedData['max_views'],
        ]);
    }

    public function show(Secret $secret)
    {
        request()->hasValidSignature() || abort(403);

        if ($secret->views >= $secret->max_views || now('UTC') > $secret->expires_at) {
            $secret->delete();
            abort(404);
        }

        $secret->increment('views');

        return view('secrets.show', [
            'secret' => $secret->content,
            'expires_in' => $secret->expires_at->diffForHumans(),
            'views' => $secret->max_views - $secret->views,
        ]);
    }
}
