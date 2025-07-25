<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactsController extends Controller
{
    // 入力フォーム表示
    public function create()
    {
        return view('contacts.create');
    }

    // 確認画面表示
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();
        return view('contacts.confirm', compact('inputs'));
    }


    public function store(ContactRequest $request)
    {
        //データ保存
        Contact::create($request->validated());

        return redirect()->route('contacts.thanks');
    }
}
