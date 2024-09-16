<!DOCTYPE html>
<html>
<head>
    <title>Print Example</title>
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
        }
    </style>
</head>
<body>

<table>
    @for($i = 0; $i < 21; $i++)
        @if($i % 3 == 0)
            <tr>
                @endif
                
                <td width="33%">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <p>Code : {{ $product->code }}</p>
                            <p>Rs. : {{ $product->MRP }}</p>
                            <p>Name : {{ $product->name }}</p>
                        </div>
                    </div>
                </td>
                
                @if($i % 3 == 2)
            </tr>
            @endif
            @endfor
            
            {{-- Close the last row if it’s not a full row of 3 items --}}
            @if(21 % 3 != 0)
                </tr>
        @endif
</table>

</body>
</html>
