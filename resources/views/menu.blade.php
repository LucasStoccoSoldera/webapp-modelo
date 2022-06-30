<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Menu</title>
</head>

<body>
    <ul>
        <li>
            <a id="btn-usuario" href="{{ route('usuario') }}" class="btn btn-primary">Usuario</a>
        </li>
        <li>
            <a id="btn-cliente" href="{{ route('cliente') }}" class="btn btn-primary">Cliente</a>
        </li>
        <li>
            <a id="btn-produto" href="{{ route('produto') }}" class="btn btn-primary">Produto</a>
        </li>
        <li>
            <a id="btn-pedido" href="{{ route('pedido') }}" class="btn btn-primary">Pedido</a>
        </li>
        <li>
            <a id="btn-pedido" href="{{ route('logout') }}" class="btn btn-primary">Sair - Logout</a>
        </li>
    </ul>
</body>

</html>
