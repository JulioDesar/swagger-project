<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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

    <x-bladewind::card>

        <form method="put" class="update-form">
            @csrf
            <h1 class="my-2 text-2xl font-light text-blue-900/80">Update Account</h1>
            <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                Digite seu nome completo, email e senha para atualizar sua conta.
            </p>

            <x-bladewind::input id="fname" required="true" label="Full Name" value="{{ $user->nome }}" error_message="You will need to enter your full name" />

            <div class="flex gap-4">

                <x-bladewind::input id="email" required="true" label="Email" value="{{ $user->email }}" />

                <x-bladewind::input id="senha" type="password" required="true" label="Senha" value="{{ $user->senha }}" />

            </div>

            <x-bladewind::button can_submit="true">Atualizar Usuario</x-bladewind::button>

        </form>

    </x-bladewind::card>

    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

<script>
    dom_el('.update-form').addEventListener('submit', function(e) {
        e.preventDefault();
        update();
    });

    update = () => {
        (validateForm('.update-form')) ?
        unhide('.btn-save .bw-spinner'):
            hide('.btn-save .bw-spinner');

        const fname = document.getElementById('fname').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('senha').value;

        const data = {
            id: `{{ $user->id }}`,
            nome: fname,
            email: email,
            senha: password
        }

        $.ajax({
            url: `/update/{{ $user->id }}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function(result) {
                alert('Atualizado com sucesso');
                window.location.href = `/`;
            },
            error: function(err) {
                alert('Erro ao atualizar');
                console.log(err);
            }
        });
    }
</script>

</html>