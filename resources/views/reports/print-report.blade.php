{{-- @extends('layouts.print')
@section('content')


    <!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <!-- Adjust headers based on your report data -->
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->field1 }}</td>
                    <td>{{ $item->field2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
@endsection --}}
