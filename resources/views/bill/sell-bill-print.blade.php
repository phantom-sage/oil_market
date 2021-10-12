{{--{{ $customer->sell_bills }}--}}
<!-- customer_bills -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-9 mx-auto">
            <h3 class="text-center">{{ $customer->name }}</h3>
            <table class="table table-sm table-responsive">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('launcher.item_name') }}</th>
                    <th scope="col">{{ __('launcher.item_unit_id') }}</th>
                    <th scope="col">{{ __('launcher.amount') }}</th>
                    <th scope="col">{{ __('launcher.money') }}</th>
                </tr>
                </thead>
                @if ($customer->sell_bills)
                    <tbody>
                    @foreach($customer->sell_bills as $customer_bill)
                        <tr>
                            <th scope="row">{{ $customer_bill->id }}</th>
                            <td>{{ $customer_bill->item_name }}</td>
                            <td>{{ $customer_bill->item_unit }}</td>
                            <td>{{ $customer_bill->item_amount }}</td>
                            <td>{{ $customer_bill->money }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row">-</th>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ __('launcher.summation') }}</td>
                        <td>{{ $customer->sell_bills->sum('money') }}</td>
                    </tr>
                    </tbody>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>
