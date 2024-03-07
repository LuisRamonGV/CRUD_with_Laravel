<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorgin='anonymous'></script>

    <!-- Enlaces a los archivos Uikit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/css/uikit.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/css/uikit-rtl.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.6/js/uikit-icons.min.js"></script>


    <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #offcanvas-push">-</button>

    <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
        <div class="uk-offcanvas-bar">
    
            <button class="uk-offcanvas-close" type="button" uk-close></button>
    
            <h3>Title</h3>
    
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    
        </div>
    </div>

</head>

<body>

    {{-- Notificaciones --}}
    @if (session('correct'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('correct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('incorrect'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('incorrect') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Modal agregar-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('productos.store') }}" method="POST" id="formAgregarProducto">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputCode" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCode" class="form-label">Precio del producto</label>
                            <input type="number" step="any" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="precio" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputCode" class="form-label">Cantidad del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="cantidad" required>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="liveAlertBtn">Agregar</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <div class="p-5 table-responsive">
        <div class="d-flex justify-content-between">
            <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
                Agregar producto
            </button>
            <form action="{{ route('productos.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar productos" name="search">
                    <button type="button" class="btn btn-info">Buscar</button>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre del producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                {{-- @if (isset($search))
                    <p>Resultados de la búsqueda para: "{{ $search }}"</p>
                @endif --}}
                @foreach ($productos as $producto)
                    <tr>
                        <th>{{ $producto->id_producto }}</th>
                        <td>{{ $producto->nombre }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td style="width: 6rem;">
                            <a href="" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $producto->id_producto }}"
                                class="btn btn-warning btn-sm mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro que deseas eliminar este producto?')">
                                    <i class="fa-solid fa-delete-left"></i>
                                </button>
                            </form>
                        </td>

                        <!-- Modal editar-->
                        <div class="modal fade" id="modalEditar{{ $producto->id_producto }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del
                                            producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="exampleInputCode" class="form-label">Nombre del
                                                    producto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="nombre"
                                                    value="{{ $producto->nombre }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputCode" class="form-label">Precio del
                                                    producto</label>
                                                <input type="number" step="any" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp" name="precio"
                                                    value="{{ $producto->precio }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputCode" class="form-label">Cantidad del
                                                    producto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="cantidad"
                                                    value="{{ $producto->cantidad }}" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val();
    
                $.ajax({
                    url: '/productos/search',
                    method: 'GET',
                    data: { search: searchTerm },
                    success: function(response) {
                        $('#productosTable').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}

</body>

</html>
