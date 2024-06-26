@extends('layout.conquer')

@section('content')
    <div class="container">
        <h1><b>DATA TRANSACTION</b></h1>
        <p>this all data from transaction table</p>
        <a class="btn btn-success" href="{{ route('transaction.create') }}">+ new transaction</a>
        <a href="#modalCreate" data-toggle="modal" class="btn btn-info">+ New Type (with Modals)</a>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kasir</th>
                    <th>Customer</th>
                    <th>Tanggal Transaction</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $d)
                    <tr id="tr_{{ $d->id }}">
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>{{ $d->customer->name }}</td>
                        <td>{{ $d->created_at }}</td>
                        <td>
                            <a class="btn btn-success" data-toggle="modal" href="#myModal"
                                onclick="getDetailData({{ $d->id }})"> Rincian Pembelian</a>
                            <a class="btn btn-warning" href="{{ route('transaction.edit', $d->id) }}">Edit</a>
                            <a href="#modalEditA" class="btn btn-warning
                            " data-toggle="modal"
                                onclick="getEditForm({{ $d->id }})">Edit Type A</a>
                            <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                onclick="if(confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ')) deleteDataRemoveTR({{ $d->id }})">Delete
                                without Reload</a>
                            <form method="POST" action="{{ route('transaction.destroy', $d->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="delete" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Detail Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content" id="msg">
                <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                    style="width: 100px;">
                <p>Loading...</p>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Add New Type</h2>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transaction.store') }}">
                        @csrf
                        <h2>Add new Transaction</h2>

                        <div class="form-group">
                            <label for="user">User</label>
                            <select class="form-control" name="user" required>
                                <option value="" selected disabled>Pilih User</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer">Customer</label>
                            <select class="form-control" name="customer" required>
                                <option value="" selected disabled>Pilih Customer</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h3>Product</h3>
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" name="product" required>
                                <option value="" selected disabled>Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Quantity of Product</label>
                            <input type="text" name="quantity" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter Quantity of Product">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>
                        <div class="form-group">
                            <label for="name">Subtotal of Product</label>
                            <input type="text" name="subtotal" class="form-control" id="nameCategory"
                                aria-describedby="nameHelp" placeholder="Enter Subtotal of Product">
                            <small id="nameHelp" class="form-text text-muted">Please write down your data here</small>
                        </div>

                        <a class="btn btn-info" href="{{ route('transaction.index') }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection

@section('javascript')
    <script>
        function getDetailData(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.showAjax') }}',
                data: '_token= <?php echo csrf_token(); ?> &id=' + id,
                success: function(data) {
                    $("#msg").html(data.msg);
                }
            });
        }

        function getEditForm(transaction_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': transaction_id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            });
        }

        function deleteDataRemoveTR(transaction_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.deleteData') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': transaction_id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#tr_' + transaction_id).remove();
                    }
                }
            });
        }
    </script>
@endsection
