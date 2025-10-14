<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
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
        <h2>Contact</h2>
      </div>
      <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" name="name" value="{{ $contact['first_name'] }}  {{ $contact['last_name'] }}" readonly />
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                <input type="text" name="gender" value="{{ $contact['gender_label'] }}" readonly />
                 <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel" value="{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}" readonly />
                  <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                  <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                  <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ $contact['address']}}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="text" name="building" value="{{ $contact['building']}}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                <input type="text" name="category_id" value="{{ $contact['category_id_label']}}" readonly />
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
              <div class="confirm-table__text__text">
                 {{ $contact['detail']}}
              </div>
                <input type="hidden" name="detail" value="{{ $contact['detail']}}">
              </td>
            </tr>
          </table>
        </div>
          <div class="form__button-group">
            <button class="form__button-submit" type="submit" name="action" value="submit">送信</button>
            <button type="submit" class="modify" name="action" value="back">修正</button>
          </div>
      </form>

    </div>
  </main>
</body>
</html>

