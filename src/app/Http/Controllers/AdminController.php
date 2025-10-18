<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;


class AdminController extends Controller
{
     public function admin(Request $request)
{
    $query = Contact::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%')
              ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$request->keyword}%"]);
        });
    }

    if ($request->filled('gender') && $request->gender !== 'all') {
    $query->where('gender', $request->gender);
}


    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->with('category')->paginate(7)->appends($request->query());
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
}


    public function show($id)
{
    if (request()->ajax()) {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.modal_detail', compact('contact'));
    }
    return redirect()->route('admin');
}

    public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return redirect()->route('admin');
}

    public function export(Request $request): StreamedResponse
    {
    $query = Contact::query();

    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('gender') && $request->gender !== 'all') {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->with('category')->get();

    $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$fileName}",
    ];

    return response()->stream(function () use ($contacts) {
        $handle = fopen('php://output', 'w');
        $columns = ['ID', '名前', '性別', 'メールアドレス', '電話番号','住所','建物名','お問い合わせ種類','お問い合わせ内容', '送信日時'];
        mb_convert_variables('SJIS-win', 'UTF-8', $columns);
        fputcsv($handle, $columns);

        foreach ($contacts as $contact) {
            $row = [
                $contact->id,
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '未分類',
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s'),
            ];
            mb_convert_variables('SJIS-win', 'UTF-8', $columns);
            mb_convert_variables('SJIS-win', 'UTF-8', $row);
            fputcsv($handle, $row);
        }

        fclose($handle);
    }, 200, $headers);
}


}