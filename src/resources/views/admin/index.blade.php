@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-6 ">
    <h2 class="text-2xl font-bold mb-6">お問い合わせ一覧</h2>

     @if (session('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif


<form method="GET" action="{{ route('admin.contacts.export') }}" class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4 items-center">
    <input type="hidden" name="name" value="{{ request('name') }}">
    <input type="hidden" name="email" value="{{ request('email') }}">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
    <input type="hidden" name="end_date" value="{{ request('end_date') }}">

    <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">エクスポート</button>
</form>
    
<form method="GET" action="{{ route('admin.index') }}" class="mb-4 flex flex-wrap gap-4">
    <input type="text" name="name" value="{{ request('name') }}" placeholder="名前で検索" class="border rounded px-2 py-1">
    <input type="text" name="email" placeholder="メールで検索" value="{{ request('email') }}">
    
    <select name="gender">
        <option value="">性別を選択</option>
        <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
        <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
        <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->content }}
            </option>

        @endforeach
    </select>
    
    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">

    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">検索</button>
    <a href="{{ route('admin.index') }}" class="text-blue-500 underline">リセット</a>
</form>

    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">お名前</th>
                <th class="border px-4 py-2">性別</th>
                <th class="border px-4 py-2">メールアドレス</th>
                <th class="border px-4 py-2">お問い合わせの種類</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse ($contacts as $contact)
                <tr>
                    <td class="border px-4 py-2">{{ $contact->last_name }} {{$contact->first_name}}</td>
                    <td class="border px-4 py-2">{{ $contact->gender }}</td>
                    <td class="border px-4 py-2">{{ $contact->email }}</td>
                    <td class="border px-4 py-2">{{ $contact->category->content ?? '―' }}
                    <td>
            <button
                data-id="{{ $contact->id }}"
                data-first_name="{{ $contact->first_name }}"
                data-last_name="{{ $contact->last_name }}"
                data-gender="{{ $contact->gender }}"
                data-email="{{ $contact->email }}"
                data-tel="{{ $contact->tel }}"
                data-address="{{ $contact->address }}"
                data-building="{{ $contact->building }}"
                data-category="{{ $contact->category->content }}"
                data-detail="{{ $contact->detail }}"
                class="modal-open px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                詳細
            </button>
            </td>
        </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">データがありません。</td>
                </tr>
            @endforelse


            <!-- flatpickr CDN -->
    @section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        locale: "ja"
    });
    
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal');
        const closeBtn = document.getElementById('modal-close');
        const deleteForm = document.getElementById('delete-form');

        const modalFields = {
            name: document.getElementById('modal-name'),
            gender: document.getElementById('modal-gender'),
            email: document.getElementById('modal-email'),
            tel: document.getElementById('modal-tel'),
            address: document.getElementById('modal-address'),
            building: document.getElementById('modal-building'),
            category: document.getElementById('modal-category'),
            detail: document.getElementById('modal-detail'),
        };

        document.querySelectorAll('.modal-open').forEach(button => {
            button.addEventListener('click', () => {
                modalFields.name.textContent = button.dataset.last_name + ' ' + button.dataset.first_name;
                modalFields.gender.textContent = button.dataset.gender;
                modalFields.email.textContent = button.dataset.email;
                modalFields.tel.textContent = button.dataset.tel;
                modalFields.address.textContent = button.dataset.address;
                modalFields.building.textContent = button.dataset.building;
                modalFields.category.textContent = button.dataset.category;
                modalFields.detail.textContent = button.dataset.detail;

                deleteForm.action = `/admin/contacts/${button.dataset.id}`;
                modal.classList.remove('hidden');
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    });
</script>
    @endsection
    </tbody>
    </table>
<!-- モーダルウィンドウ--->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <button id="modal-close" class="absolute top-2 right-4 text-gray-500 hover:text-gray-700 text-xl">x</button>

            <h2 class="text-xl font-bold mb-4">お問い合わせ詳細</h2>

            <div class="space-y-2">
                <p><strong>お名前：</strong><span id="modal-name"></span></p>
                <p><strong>性別：</strong><span id="modal-gender"></span></p>
                <p><strong>メールアドレス：</strong><span id="modal-email"></span></p>
                <p><strong>電話番号：</strong><span id="modal-tel"></span></p>
                <p><strong>住所：</strong><span id="modal-address"></span></p>
                <p><strong>建物名：</strong><span id="modal-building"></span></p>
                <p><strong>お問い合わせの種類：</strong><span id="modal-category"></span></p>
                <p><strong>お問い合わせ内容：</strong><span id="modal-detail"></span></p>
            </div>

            <form id="delete-form" method="POST" class="mt-6 text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">削除</button>
        </form>
        </div>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
    <div class="mt-6">
            <a href="{{ route('admin.index') }}" class="text-sm text-gray-500 underline">
                トップページに戻る
            </a>
        </div>
</div>
@endsection