<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('admin/stats.title')}}</title>
</head>
<body>
<h1>{{__('admin/stats.desc') . Carbon\Carbon::create($year, $month)->locale(App::getLocale())->translatedFormat('F Y')}}</h1>

<p>{{__('admin/stats.animals') . $animals->count()}}</p>
<p>{{__('admin/stats.adoptions') . $adoptions->count()}}</p>
<p>{{__('admin/stats.animalsAdoptable') . $animalsAdoptable->count()}}</p>
</body>
</html>
