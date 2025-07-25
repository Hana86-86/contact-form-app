<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $query = Contact::with('category');

        if (!empty($request->name)) {
    $query->where(function ($q) use ($request) {
        $q->where('last_name', 'like', '%' . $request->name . '%')
          ->orWhere('first_name', 'like', '%' . $request->name . '%')
          ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $request->name . '%']);
    });
}

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email .'%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender );
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id );
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=',$request->start_date );
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at','<=', $request->end_date );
        }
        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin.index', compact('contacts','categories'));

        }

    // CSVエクスポート
    public function export(Request $request)
        {
        $query = Contact::with('category');

        if (!empty($request->name)) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->name . '%')
                  ->orWhere('first_name', 'like', '%' . $request->name . '%')
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $request->name . '%']);
            });
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email .'%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender );
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id );
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=',$request->start_date );
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at','<=', $request->end_date );
        }

        $contacts = $query->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // ヘッダー
            fputcsv($handle, [
                'ID', '名前', '性別', 'メール', '電話番号', '住所', '建物名', 'カテゴリー', '内容', '登録日'
            ]);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->id,
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '',
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
    });

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
}

        public function destroy($id)
        {
            $contact = Contact::findOrFail($id);
            $contact->delete();

        return redirect()->route('admin.index')->with('message', 'お問い合わせを削除しました。');
}

}



