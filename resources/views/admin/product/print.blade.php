<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .card {
            padding: 20px;
        }

        .card-body p {
            margin: 5px 0;
        }

        td {
            vertical-align: top;
            padding: 10px;
            width: 33%;
        }
    </style>
</head>
<body>

<table>
    <tr>
        @php
            $counter = 0; // To keep track of items in the row
        @endphp
        
        @foreach($products as $product)
            @for($i = 0; $i < $product->qty; $i++)
                <td>
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <p>Code : {{ $product->code }}</p>
                            <p>Rs. : {{ $product->MRP }}</p>
                            @if($product->is_name_print)
                                <p>Name : {{ $product->name }}</p>
                            @endif
                        </div>
                    </div>
                </td>
                
                @php
                    $counter++;
                @endphp
                
                {{-- Start a new row every 3 items --}}
                @if($counter % 3 == 0)
    </tr>
    <tr>
        @endif
        @endfor
        @endforeach
        
        {{-- Close the last row if it’s not a full set of 3 --}}
        @if($counter % 3 != 0)
            @for($j = 0; $j < 3 - ($counter % 3); $j++)
                <td></td>
            @endfor
        @endif
    </tr>
</table>

</body>
</html>
