@props([
    'title' => null,
])

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title.when($title, ' - ').config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<script>
    (function () {
        try {
            var isCollapsed = localStorage.getItem('flux-sidebar-collapsed-desktop') === 'true'
            document.documentElement.style.setProperty('--sidebar-width', isCollapsed ? '3.5rem' : '18rem')
        } catch (e) {
        }
    })()
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
