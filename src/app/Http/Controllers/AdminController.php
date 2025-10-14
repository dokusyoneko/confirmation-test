<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class AdminController extends Controller
{
     public function admin()
{
    $contacts = Contact::with('category')->get()->map(function ($contact) {
        return [
            'id' => $contact->id,
            'name' => "{$contact->first_name}　{$contact->last_name}",
            'gender' => $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
            'email' => $contact->email,
            'category' => $contact->category->content ?? '未分類',
        ];
    });

    return view('admin', compact('contacts'));
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

    return response()->json(['message' => '削除が完了しました']);
}



}