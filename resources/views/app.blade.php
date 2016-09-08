
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css">
<link href='css/app.css' rel='stylesheet' type='text/css'>
</head>
<body>
 
@yield('content')
 
@section('sidebar')
@show
 
</div>
 
 
<footer class="row">
<div class="large-12 columns">
<hr/>
<div class="row">
<div class="large-12 columns">
<p><a href="/">Sanction Search</a></p>
</div>
</div>
</div>
</footer>
</body>
</html>
