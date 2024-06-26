<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Products</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
</head>

<body>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Products</h1>
                <p class="lead text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum ipsam
                    distinctio nulla odit ab accusantium deleniti asperiores officiis! Praesentium commodi reprehenderit
                    adipisci tempore quaerat odit laborum fugiat quidem in qui!</p>
                <a class="btn btn-success" href="{{ route('product.create') }}">+ New Product</a>
                <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a>
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($products as $p)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm" id="tr_{{ $p->id }}">
                                <img class="card-img-top" src="{{ asset('images/' . $p->image) }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $p->name }}</h5>
                                    <h7>{{ $p->hotel->name }}</h7>
                                    <p class="card-text">{{ $p->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-secondary"
                                                href="{{ route('product.edit', $p->id) }}">Edit</a>
                                            <a href="#modalEditA" class="btn btn-sm btn-outline-secondary"
                                                data-toggle="modal" onclick="getEditForm({{ $p->id }})">Edit Type
                                                A</a>
                                            <a href="#" value="DeleteNoReload"
                                                class="btn btn-sm btn-outline-secondary"
                                                onclick="if(confirm('Are you sure to delete {{ $p->id }} - {{ $p->name }} ? ')) deleteDataRemoveTR({{ $p->id }})">Delete
                                                without Reload</a>
                                            <form method="POST" action="{{ route('product.destroy', $p->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    onclick="return confirm('Are you sure to delete {{ $p->id }} - {{ $p->name }} ? ');">
                                            </form>
                                        </div>
                                        <small class="text-muted">Price: {{ $p->price }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <!-- Create Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Product</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('product.store') }}">
                        @csrf
                        <h2>Add new Product</h2>
                        <div class="form-group">
                            <label for="name">Name of Product</label>
                            <input type="text" name="name" class="form-control" id="nameProduct"
                                aria-describedby="nameHelp" placeholder="Enter name of Product">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="price">Price of Product</label>
                            <input type="text" name="price" class="form-control" id="priceProduct"
                                aria-describedby="priceHelp" placeholder="Enter Price of Product">
                            <small id="priceHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="image">Image of Product</label>
                            <input type="text" name="image" class="form-control" id="imageProduct"
                                aria-describedby="imageHelp" placeholder="Enter Image of Product">
                            <small id="imageHelp" class="form-text text-muted">Please write down your data
                                here</small>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description of Product</label>
                            <input type="text" name="desc" class="form-control" id="descProduct"
                                aria-describedby="descHelp" placeholder="Enter Description of Product">
                            <small id="descHelp" class="form-text text-muted">Please write down your data
                                here</small>
                        </div>
                        <div class="form-group">
                            <label for="room">Available Room of Product</label>
                            <input type="text" name="room" class="form-control" id="roomProduct"
                                aria-describedby="roomHelp" placeholder="Enter available room of Product">
                            <small id="roomHelp" class="form-text text-muted">Please write down your data
                                here</small>
                        </div>
                        <div class="form-group">
                            <label for="hotel">Hotel of Product</label>
                            <select class="form-control" name="hotel">
                                <option value="" selected disabled>Select Hotel</option>
                                @foreach ($hotels as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-info" href="{{ route('product.index') }}"
                                data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal A -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                        style="width: 100px;">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <!-- Pastikan jQuery dimuat sebelum skrip yang membutuhkannya -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        // Sekarang Anda dapat menggunakan fungsi $.ajax setelah jQuery dimuat
        function getEditForm(product_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': product_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(product_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('product.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': product_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + product_id).remove();
                    }
                }
            });
        }
    </script>

</body>

</html>
