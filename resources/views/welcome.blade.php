<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-----------------------------------------------------------
        -- animate.min.css by Daniel Eden (https://animate.style)
        -- is required for the animation of notifications and slide out panels
        -- you can ignore this step if you already have this file in your project
        --------------------------------------------------------------------------->

    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet" />
</head>

<body>

    <x-bladewind::button onclick="createUsers()">Criar Usuario</x-bladewind::button>

    <x-bladewind::table exclude_columns="id" searchable="true" search_placeholder="Pesquisar" has_shadow="true" striped="true" divider="thin" :action_icons="$action_icons" :data="$staff" />

    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

<script>
    createUsers = () => {
        window.location.href = `/create`;
    }

    updateUser = (id) => {
        window.location.href = `/${id}/edit`;
    }

    deleteUser = (id) => {
        $.ajax({
            url: `/delete/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                alert('Deletado com sucesso');
                window.location.href = `/`;
            }
        });
    }

    redirect = (url) => {
        window.open(url);
    }
</script>

</html>