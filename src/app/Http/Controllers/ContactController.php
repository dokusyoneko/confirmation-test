<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
  public function index()
  {
     $categories = Category::all();
    return view('index', compact('categories'));
  }
  
  public function confirm(ContactRequest $request)
  {
    if ($request->input('action') === 'back') {
        return redirect()->route('contact.index')->withInput();
    }


    $contact = $request->only(['first_name', 'last_name','gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);

    switch ($contact['gender']) {
        case '1':
            $contact['gender_label'] = '男性';
            break;
        case '2':
            $contact['gender_label'] = '女性';
            break;
        case '3':
            $contact['gender_label'] = 'その他';
            break;
    }

    switch ($contact['category_id']) {
        case '1':
            $contact['category_id_label'] = '商品のお届けについて';
            break;
        case '2':
            $contact['category_id_label'] = '商品の交換について';
            break;
        case '3':
            $contact['category_id_label'] = '商品トラブル';
            break;
        case '4':
            $contact['category_id_label'] = 'ショップへのお問い合わせ';
            break;
        case '5':
            $contact['category_id_label'] = 'その他';
            break;
    }
    return view('confirm', compact('contact'));
  }



  public function store(ContactRequest $request)
  {
    if ($request->input('action') === 'back') {
        return redirect()->route('contact.index')->withInput();
    }

    $tel = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');
    $contact = $request->only(['first_name', 'last_name','gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
    Contact::create($contact);
    return view('thanks');
  }

  public function admin()
{
    $contacts = Contact::with('category')->get()->map(function ($contact) {
        return [
            'id' => $contact->id,
            'name' => "{$contact->last_name} {$contact->first_name}",
            'gender' => $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
            'email' => $contact->email,
            'category' => $contact->category->content ?? '未分類',
        ];
    });

    return view('admin', compact('contacts'));
}

  public function show($id)
  {
    $contact = Contact::with('category')->findOrFail($id);
    return view('admin_show', compact('contact'));
}





}

