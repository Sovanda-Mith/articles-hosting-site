<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Your website description here">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:title" content="{{ config('app.name', 'Laravel') }}">
        <meta property="og:description" content="Your website description here">
        <meta property="og:image" content="{{ asset('landingPage_img/logo.webp') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url('/') }}">
        <meta property="twitter:title" content="{{ config('app.name', 'Laravel') }}">
        <meta property="twitter:description" content="Your website description here">
        <meta property="twitter:image" content="{{ asset('landingPage_img/logo.webp') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
        <!-- Icon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('landingPage_img/logo.webp') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landingPage_img/logo.webp') }}">
        <!-- tailwindcss -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Structured Data for Logo -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ config('app.name', 'Laravel') }}",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('landingPage_img/logo.webp') }}",
            "sameAs": [
                "https://www.facebook.com/yourpage",
                "https://www.twitter.com/yourhandle",
                "https://www.instagram.com/yourhandle"
            ]
        }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    </head>
    <body>
        <div id="app"></div>

    </body>
</html>
