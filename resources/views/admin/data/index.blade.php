@extends('template_backend.home')
@section('halaman', 'List Data')
@section('content')
  @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{ Session('success') }}
    </div>
  @endif

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="welcome-wrapper shadow-reset res-mg-t mg-b-30">
      <a href="{{ route('create.data') }}" class="btn btn-primary btn-sm">Tambah Produck</a><br><br>
      <table class="table table-striped table-hover table-sm table-bordered">
        <tr>
          <th>No</th>
          <th>katagori produk</th>
          <th>nama produk</th>
          <th>harga</th>
          <th>Gambar</th>
          <th>Action</th>
        </tr>
        @foreach ($data as $result => $d)
          <tr>
            <td>{{ $result + $data->firstitem() }}</td>
            <td>{{ $d->merek->name }}</td>
            <td>{{ $d->type }}</td>
            <td>Rp. {{ $d->price }}</td>
            <td>
              <img src="{{ asset( $d->gambar ) }}" class="img-fluid" width="100" alt="">
            </td>
            <td>
              <form action="{{ route('data.destroy', $d->id) }}" method="Data">
                @csrf
                @method('delete')
                <a href="{{ route('data.edit', $d->id) }}" class="btn btn-success btn-sm">Edit</a>
                <a href="{{ route('data.delete', $d->id) }}" class="btn btn-danger btn-sm">Delete</a>
              </form>
            </td>
          </tr>
        @endforeach
      </table>
      {{ $data->links() }}
    </div>
  </div>
@endsection
