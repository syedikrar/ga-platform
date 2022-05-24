<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/dashboard/favicon.svg') }}">

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ mix('/css/backend/theme.css') }}"/>

</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
    
           
                        
                            {{ $slot }}
                     
                   
     
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('/js/backend/theme-scripts.js') }}"></script>
    <script src="{{ mix('/js/backend/theme.js') }}"></script>
    {!! NoCaptcha::renderJs() !!}
  

</html>