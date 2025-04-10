<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Base</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<style>
  body {
    font-family: 'Fira Code', monospace;
    text-wrap: pretty;
  }
  h1{
    font-size: 30px;
  }
</style>
<body class="bg-black">
  <div class="container mx-auto py-6 px-4">
      @yield('content')
  </div>
</body>
<script src="//unpkg.com/alpinejs" defer></script>
</html>