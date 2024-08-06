<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Construction</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Özel CSS stilleri */
        body {
            /* background-image: url('https://static.vecteezy.com/system/resources/previews/015/508/772/original/website-building-design-under-construction-vector.jpg'); */
            background-color: #f8f9fa;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 100px;
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.8); /* Jumbotron arka plan rengi */
            border-radius: 10px; /* Jumbotron kenar yuvarlaklığı */
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Jumbotron gölge */
            color: #333; /* Jumbotron metin rengi */
        }
        h1 {
            color: #007bff; /* Başlık rengi */
        }
        p {
            color: #666; /* Paragraf rengi */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="jumbotron text-center">
        {!! $site_under_construction_text !!}
        <a href="{{ route('login')}}">
            Giriş səhifəsinə qayıdın
        </a>
    </div>
</div>

</body>
</html>
