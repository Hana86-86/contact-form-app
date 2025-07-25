@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-center mb-6">Login</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="block mb-1">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password" class="block mb-1">パスワード</label>
        <input id="password" type="password" name="password"
                class="w-full border border-gray-300 rounded px-3 py-2">
        @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">
        ログイン
    </button>
</form>
@endsection