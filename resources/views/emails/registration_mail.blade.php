@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia úspešná</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            text-align: center;
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        h3 {
            text-align: center;
        }

        p {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Potvrdenie registrácie</h2>
    <p>Vaša registrácia prebehla úspešne. Ďakujeme a tešíme sa na Vašu návštevu.</p>
    <p>Pre odhlásenie z konferencie použite verifikačný kód:</p>
    <h3>{{ $verification_code }}</h3>

    <h4>Prihlásili ste sa na nasledujúce prednášky:</h4>
    <ul>
        @foreach($talks as $talk)
            <li>
                @foreach($talk->timeSlots as $timeSlot)
                    {{ Carbon::parse($timeSlot->start_time)->format('H:i') }} -
                    {{ Carbon::parse($timeSlot->end_time)->format('H:i') }}
                    {{ $talk->title }}
                @endforeach
            </li>
        @endforeach
    </ul>

    <p>S pozdravom,<br>byteUnbound24 Tím</p>
</div>
</body>
</html>
