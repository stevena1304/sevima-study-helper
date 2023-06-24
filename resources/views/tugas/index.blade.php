@extends('layout.body')
@section('title', 'Data Tugas')
@section('page-title', 'List Tugas')
@section('content')

    <section class="tugas">
        <div class="row">
            <div class="col">
                <button class="btn btn-info mb-2 text-white" data-bs-toggle="modal" data-bs-target="#addTask">Tambah Tugas</button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content">
            <div class="card">
                <div class="card-body">
                    <!-- table -->
                    <div class="table-responsive-lg">
                        <table class="table mt-3 " style="outline: 2px" id="tabel_tasks">
                            <thead class="table-secondary table-responsive">
                                <tr style="text-align: start">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Tenggat</th>
                                    <th>Mapel</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tugas as $t)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$t->nama_tugas}}</td>
                                    <td>{{$t->tenggat}}</td>
                                    <td>{{$t->mapel->nama_mapel}}</td>
                                    <td class="text-capitalize">{{$t->status}}</td>
                                    <td>
                                        <a href="" class="btn" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @if($t->status != 'done')
                                            <li>
                                                <form action="{{route('tugas.update', $t->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="done">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-check"></i>
                                                        Mark As Done
                                                    </button>
                                                </form>
                                            </li>
                                            @else
                                            <li>
                                                <form action="{{route('tugas.update', $t->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="undone">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-xmark"></i>
                                                        Mark As Undone
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{route('tugas.edit', $t->id)}}" class="dropdown-item" onclick="edit()">
                                                    <i class="fas fa-edit"></i>
                                                    Edit Tugas
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus Tugas
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
    </section>

    <!-- Add Mapel Modal -->
    <div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <form action="{{ route('tugas.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_mapel">Mata Pelajaran</label>
                            <select class="form-control form-select" name="mapel_id" id="mapel_id">
                                <option>Pilih Mapel</option>
                                @foreach($mapel as $m)
                                <option value="{{$m->id}}">{{$m->nama_mapel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_tugas">Nama Tugas</label>
                            <input class="form-control" type="text" name="nama_tugas" id="nama_tugas">
                        </div>
                        <div class="form-group">
                            <label for="tenggat">Tenggat</label>
                            <input class="form-control" type="date" name="tenggat" id="tenggat">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <div class="form-group">
                                <a class="btn" data-bs-dismiss="modal">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Mapel Modal -->
    <div class="modal fade" id="editTask" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <form action="" class="edit-form" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_mapel">Mata Pelajaran</label>
                            <select class="form-control form-select" name="mapel_id" id="mapel_id">
                                <option>Pilih Mapel</option>
                                @foreach($mapel as $m)
                                <option value="{{$m->id}}">{{$m->nama_mapel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_tugas">Nama Tugas</label>
                            <input class="form-control" type="text" name="nama_tugas" id="nama_tugas" value="">
                        </div>
                        <div class="form-group">
                            <label for="tenggat">Tenggat</label>
                            <input class="form-control" type="date" name="tenggat" id="tenggat" value="">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <div class="form-group">
                                <a class="btn" data-bs-dismiss="modal">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        table {
            border: 1px solid;
        }
    </style>

    <script>
        function edit(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            var form = $('.edit-form');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    var tugas = data.tugas;
                    var mapel = data.mapel;

                    //form
                    form.attr('action', '{{ route("tugas.update", ":tugas_id") }}'.replace(':tugas_id', tugas.id));

                    //mapel
                    $('#mapel_id').empty();
                    var option_null = $('<option>', {
                        value: '',
                        text: 'Pilih Mapel',
                    });
                    $('#mapel_id').append(option_null);
                    $.each(mapel, function(index, m) {
                        var option = $('<option>', {
                            value: m.id,
                            text: m.nama_mapel,
                        });
                        if (m.id === tugas.mapel_id) {
                            option.attr('selected', 'selected');
                        }
                        $('#mapel_id').append(option); // Menambahkan opsi ke elemen select
                    });

                    //tugas
                    $('#nama_tugas').val(tugas.nama_tugas);
                    $('#tenggat').val(tugas.tenggat);
                    $('#editTask').modal('show');
                },
                error: function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection