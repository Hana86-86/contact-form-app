@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 text-center">
    <h2 class="text-2xl font-bold mb-6">お問い合わせありがとうございます</h2>

    <p class="mb-6">送信が完了しました。</p>

    <a href="{{ route('contacts.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded">
        HOME
    </a>
</div>
@endsection