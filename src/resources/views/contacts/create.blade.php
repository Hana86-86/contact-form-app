@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">お問い合わせフォーム</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 入力フォーム --}}
    <form action="{{ route('contacts.confirm') }}" method="POST">
        @csrf

        {{-- 氏名（姓・名）--}}
        <div class="mb-4">
            <label class="block font-semibold">氏名<span class="text-red-500">*</span></label>
            <div class="flex gap-4">
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="姓" class="w-1/2 border rounded px-3 py-2">
                @error('last_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="名" class="w-1/2 border rounded px-3 py-2">
                @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>
        {{-- 性別--}}
        <div class="mb-4">
            <label class="block font-semibold">性別 <span class="text-red-500">*</span></label>
            <div class="flex gap-4">
                <input type="radio" name="gender" value="男性" @checked(old('gender', '男性') === '男性')> 男性
                <input type="radio" name="gender" value="女性" @checked(old('gender', '男性') === '女性')> 女性
                <input type="radio" name="gender" value="その他" @checked(old('gender', '男性') === 'その他')> その他
                @error('gender')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- メールアドレス--}}
        <div class="mb-4">
            <label class="block font-semibold">メールアドレス<span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2">
            @foreach ($errors->get('email') as $error)
                <p class="text-red-600 text-sm">{{ $error }}</p>
            @endforeach
        </div>


        {{-- 電話番号 --}}
        <div class="mb-4">
            <label class="block font-semibold">電話番号<span class="text-red-500">*</span></label>
            <input type="tel" name="tel" value="{{ old('tel') }}" class="w-full border rounded px-3 py-2" placeholder="08012345678">
            @error('tel')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
        </div>

        {{-- 住所 --}}
        <div class="mb-4">
            <label class="block font-semibold">住所<span class="text-red-500">*</span></label>
            <input type="text" name="address" value="{{ old('address') }}" class="w-full border rounded px-3 py-2">
            @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
        </div>

        {{-- 建物名 --}}
        <div class="mb-4">
            <label class="block font-semibold">建物名（任意）</label>
            <input type="text" name="building" value="{{ old('building') }}" class="w-full border rounded px-3 py-2">
        </div>

        {{-- お問い合わせの種類--}}
        <div class="mb-4">
            <label class="block font-semibold">
                お問い合わせの種類<span class="text-red-500">*</span>
        </label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                <option value="1" {{old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="2" {{old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
                <option value="3" {{old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
                <option value="4" {{old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="5" {{old('category_id') == 5 ? 'selected' : '' }}>その他</option>
            </select>
            @error('category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
        </div>

        {{-- お問い合わせ内容--}}
        <div class="mb-4">
            <label class="block font-semibold">お問い合わせ内容<span class="text-red-500">*</span></label>
            <textarea name="detail" rows="5" class="w-full border rounded px-3 py-2" maxlength="120">{{ old('detail') }}</textarea>
            @error('detail')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
        </div>

        {{-- 確認ボタン --}}
        <div class="mb-6">
            <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white font-semibold py-2 px-6 rounded shadow">
                確認画面へ
            </button>
        </div>
    </form>
</div>
@endsection