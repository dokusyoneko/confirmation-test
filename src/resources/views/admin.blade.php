<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>

  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Admin</h2>
        </div>

        {{--検索とか色々--}}
        <div class="search__zone">
                <input class="search__name__input" type="text" placeholder="名前やメールアドレスを入力してください">
                <select class="search__gender__select">
                <option>性別</option>
                </select>
                <select class="search__category__select">
                <option>お問い合わせ種類</option>
                </select>
                <input class="search__date__input" type="date" value="年/月/日">
                <button class="search__button__submit">検索</button>
                <button class="search__reset__button">リセット</button>
        </div>


        <div class="admin__table__wrapper ">
            <table class="admin__table">
                <tr class="admin__header__row">
                    <th class="name">お名前</th>
                    <th class="gender">性別</th>
                    <th class="mail">メールアドレス</th>
                    <th class="category_id">お問い合わせの種類</th>
                    <th class="syousai"></th>
                </tr>
                @foreach ($contacts as $contact)
                <tr class="admin__data__row">
                    <td class="name">{{ $contact['name'] }}</td>
                    <td class="gender">{{ $contact['gender'] }}</td>
                    <td class="email">{{ $contact['email'] }}</td>
                    <td class="category_id">{{ $contact['category'] }}</td>
                    <td class="syousai">
                        <a href="{{ route('admin.show', ['id' => $contact['id']]) }}" class="admin__detail__link">詳細</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- モーダルウィンドウ -->
        <div id="modal" class="modal hidden">
  <div class="modal__content">
    <span class="modal__close">&times;</span>
    <div id="modal__body">
      <!-- 詳細情報がここに読み込まれる -->
    </div>
  </div>
</div>


  </main>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');
    const modalBody = document.getElementById('modal__body');
    const closeBtn = document.querySelector('.modal__close');

    document.querySelectorAll('.admin__detail__link').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault();
    const url = this.getAttribute('href');

    fetch(url, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.text())
    .then(html => {
      modalBody.innerHTML = html;
      modal.classList.remove('hidden');
      const deleteBtn = modalBody.querySelector('.delete__button');
          if (deleteBtn) {
            deleteBtn.addEventListener('click', function () {
              const id = this.dataset.id;

              fetch(`/admin/${id}`, {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                  'X-Requested-With': 'XMLHttpRequest'
                }
              })
              .then(response => response.json())
              .then(data => {
                modal.classList.add('hidden');
                modalBody.innerHTML = '';
                location.reload();

                const row = document.querySelector(`a[href$="/admin/${id}"]`)?.closest('tr');
                if (row) row.remove();
              });
            });
          }

    });
  });
});


    closeBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      modalBody.innerHTML = '';
    });
  });
</script>


</body>
</html>