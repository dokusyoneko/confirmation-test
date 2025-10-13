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

        {{--検索とか色々--}}
        <div class="search__zone">
            <div class="search__input">
                <input type="text" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search__gender">
                <select class="search__gender__select">
                <option>性別</option>
                </select>
            </div>
            <div class="search__category">
                <select class="search__category__select">
                <option>お問い合わせ種類</option>
                </select>
            </div>
            <div class="search__date">
                <input type="date" value="年/月/日">
            </div>
            <div class="search__button">
                <button class="search__button__submit">検索</button>
            </div>
            <div class="search__reset">
                <button class="search__reset__button">リセット</button>
            </div>
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
  </main>
</body>
</html>