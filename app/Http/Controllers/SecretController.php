<?php

namespace App\Http\Controllers;

use App\Http\Requests\SecretRequest;
use App\Models\Secret;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SecretController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return Secret::all();
    }

    public function store(SecretRequest $request)
    {
        return Secret::create($request->validated());
    }

    public function show(Secret $secret)
    {
        return $secret;
    }
}
