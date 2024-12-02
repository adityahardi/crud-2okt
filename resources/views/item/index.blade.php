@extends('layouts.main', ['title' => 'Item List', 'description'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">View Item</h3>
                <hr>
                <form class="mb-2" action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('item.create') }}" class="btn btn-md btn-success mb-3">ADD ITEM</a>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">IMAGE</th>
                            <th scope="col" style="width: 20%">ACTIONS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/items/'.$item->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('item.destroy', $item->id) }}" method="POST">
                                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Item belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
