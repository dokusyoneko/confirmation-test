<div class="confirm-modal__content">
  <p><strong>お名前</strong>{{ $contact->first_name }} {{ $contact->last_name }}</p>
  <p><strong>性別</strong>{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他') }}</p>
  <p><strong>メールアドレス</strong>{{ $contact->email }}</p>
  <p><strong>電話番号</strong>{{ $contact->tel}}</p>
  <p><strong>住所</strong>{{ $contact->address ?? '' }}</p>
  <p><strong>建物名</strong>{{ $contact->building ?? '' }}</p>
  <p><strong>お問い合わせの種類</strong>{{ $contact->category->content ?? '未分類' }}</p>
  <p><strong>お問い合わせ内容</strong>{{ $contact->detail ?? '' }}</p>

  <form method="POST" action="{{ route('admin.delete', ['id' => $contact->id]) }}">
    @csrf
    @method('DELETE')
    <button class="delete__button" data-id="{{ $contact->id }}">削除</button>

  </form>
</div>

