<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">    
        @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="bg-dark py-3 flex justify-between px-6">
        <h3 class="text-white text-center m-auth">EL MOKHTAR JBARA</h3>
        @auth
        <div class="flex items-center space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-blue-500 hover:text-blue-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="flex">
                    @csrf
                    <a href="{{ route('logout') }}" class="text-sm text-blue-500 hover:text-blue-300"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:text-blue-300">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-blue-500 hover:text-blue-300">Register</a>
                @endif
            @endauth
        </div>
    @endauth

    @guest
    <a
    href="{{ route('login') }}"
    class="rounded-md text-white "
>
    Log in
</a>

    @endguest
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            @auth
                
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
            </div>
            @endauth
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Created_at</th>
                                <th>Action only in auth</th>
                                
                            </tr>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img width="50"
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        @auth
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="#" onclick="deleteProduct({{ $product->id }});"
                                                class="btn btn-danger">Delete</a>
                                            <form id="delete-product-from-{{ $product->id }}"
                                                action="{{ route('products.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                        @endauth
                                    </tr>
                                @endforeach

                            @endif

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete product?")) {
            document.getElementById("delete-product-from-" + id).submit();
        }
    }
</script>
