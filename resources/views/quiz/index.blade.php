<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if ($quiz::QUIZ_CHAPTER == $quiz->quizzable_type)
        <title>Kuis {{ $quiz->quizzable->chapter_name }}</title>
    @else
        <title>Kuis {{ $quiz->quizzable->course_name }}</title>
    @endif

    <style>
        * {
            overflow-y: hidden;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <iframe src="{{ $quiz->link_quiz }}" style="width: 100%; height: 100vh;" frameborder="0" marginheight="0"
        marginwidth="0" scrolling="yes" noresize>Memuat…</iframe>
</body>

</html>
