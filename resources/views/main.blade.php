<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Тестовое задание</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid">

            <div class="position-absolute top-0 end-0">
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger m-3">
                        {{ $error }}
                    </p>
                @endforeach
                @if(session()->has('message'))
                    <p class="alert alert-success m-3">
                        {{ session()->get('message') }}
                    </p>
                @endif
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="row align-content-center vh-100">
                        <div class="fs-5 fw-bold">Текущее содержание таблиц</div>
                        <div class="col-6">
                            @foreach ($advertisers as $advertiser)
                                <div class="fs-6 fst-italic">{{ $advertiser->advertiser }} ({{ $advertiser->adv_id }})</div>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Паб ИД</th>
                                            <th scope="col">Сайт ИД</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blacklists as $blacklist)
                                            @if ($blacklist->adv_id == $advertiser->adv_id)
                                                <tr>
                                                    <td>{{ $blacklist->publisher_id }}</td>
                                                    <td>{{ $blacklist->site_id }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row align-content-center vh-100">

                        <div class="row justify-content-center ">
                            <div class="col fs-4">Демо первый метод</div>
                            <div class="w-100"></div>
                            <div class="col border">
                                <form action="{{ route('blacklist.add') }}" method="POST" class="mb-3">
                                    @csrf
                                    {{-- @method('POST') --}}
                                    <label class="form-label" for="blacklist">Блэклист</label>
                                    <input class="form-control" name="blacklist" type="text" value="{{ old('blacklist') }}">

                                    <label class="form-label" for="adv_id">Идентификатор рекламодателя</label>
                                    <input class="form-control mb-3" name="adv_id" type="text" value="{{ old('adv_id') }}">

                                    <button class="btn btn-outline-primary" type="submit">Ок</button>
                                </form>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col fs-4">Демо второй метод</div>
                            <div class="w-100"></div>
                            <div class="col border">
                                <form action="{{ route('blacklist.show') }}" method="POST" class="mb-3">
                                    @csrf
                                    @method('POST')
                                    <label class="form-label" for="id">Идентификатор рекламодателя</label>
                                    <input class="form-control mb-3" name="advertiser_id" type="text" value="{{ old('advertiser_id') }}">

                                    <button class="btn btn-outline-primary" type="submit">Ок</button>
                                </form>
                            </div>
                            @if(session()->has('blacklists'))
                                <p class="m-3">
                                    "{{ session()->get('blacklists') }}"
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="row align-content-center vh-100">
                        <div class="col-12 fs-5 f-bold">Тестовые данные</div>
                        <div class="col-12">
                            <p>Блэклист пример:</p>
                            <p>"p99, s999"</p>
                        </div>

                        <div class="col">
                            <p>Ищем:
                                @if($rand->site_id)
                                    {{ $rand->site_id }} - {{ $rand->site }}
                                @else
                                    {{ $rand->publisher_id }} - {{ $rand->publisher }}
                                @endif
                            </p>
                            @foreach ($allAdvertisers as $adv)
                                <p>Отправлено: {{ $adv->advertiser }} ({{ $adv->adv_id }})</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
