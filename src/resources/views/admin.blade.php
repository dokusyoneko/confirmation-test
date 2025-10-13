<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
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
    <div>
        {{--検索とか色々--}}
    </div>

    <table class="admin__table__inner">
        <tr class="admin__heder__row">
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
  </main>

</body>

</html>