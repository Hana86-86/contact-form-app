@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h2 class="text-xl font-bold mb-6">内容確認</h2>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <bt class="font-semibold">氏名</bt>
            <dd class="mb-4">{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</dd>

            <dt class="font-semibold">性別</dt>
            <dd class="mb-4">{{ $inputs['gender'] }}</dd>

            <dt class="font-semibold">メールアドレス</dt>
            <dd class="mb-4">{{ $inputs['email'] }}</dd>

            <dt class="font-semibold">電話番号</dt>
            <dd class="mb-4">{{ $inputs['tel'] }}</dd>

            <dt class="font-semibold">住所</dt>
            <dd class="mb-4">{{ $inputs['address'] }}</dd>

            <dt class="font-semibold">お問い合わせの種類</dt>
            <dd class="mb-4">
                @php
                $categories = [
                    1 => '商品のお届けについて',
                    2 => '商品の交換つにいて',
                    3 => '商品トラブル',
                    4 => 'ショップへのお問い合わせ',
                    5 => 'その他',
                ];
                @endphp
                {{ $categories[$inputs['category_id']] ?? '不明'}}
            </dd>

            <dt class="font-semibold">お問い合わせ内容</dt>
            <dd class="mb-4">{{ $inputs['detail'] }}</dd>
        </div>
        {{-- 送信フォーム --}}
        <div class="flex justify-between">
        <form action="{{ route('contacts.store') }}" method="POST" class="mt-6">
            @csrf
            @foreach ($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">送信</button>
        </div>
    </form>

        <div class="flex justify-between">
            <button type="button" onclick="history.back()" class="bg-gray-300 px-4 py-2 rounded">修正</button>
        </div>
    </form>
</div>
@endsection