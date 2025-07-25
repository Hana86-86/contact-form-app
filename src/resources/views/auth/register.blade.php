@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- お名前 --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium mb-1">お名前</label>
            <input id="name" name="name" type="text" 
                    value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">メールアドレス</label>
            <input id="email" name="email" type="email" 
                    value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- パスワード --}}
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium mb-1">パスワード</label>
            <input id="password" name="password" type="password"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- 登録ボタン --}}
        <button type="submit"
                class="full bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">
            登録
        </button>
    </form>
@endsection