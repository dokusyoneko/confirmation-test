<div class="confirm-modal__content">
  <p><strong>お名前</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
  <p><strong>性別</strong>{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他') }}</p>
  <p><strong>メールアドレス</strong>{{ $contact->email }}</p>
  <p><strong>電話番号</strong>{{ $contact->tel}}</p>
  <p><strong>住所</strong>{{ $contact->address ?? '' }}</p>
  <p><strong>建物名</strong>{{ $contact->building ?? '' }}</p>
  <p><strong>お問い合わせの種類</strong>{{ $contact->category->content ?? '未分類' }}</p>
  <p><strong>お問い合わせ内容</strong>{{ $contact->detail ?? '' }}</p>

  <form action="{{ route('admin.delete', $contact->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete__button">削除</button>
  </form>

  
</div>

