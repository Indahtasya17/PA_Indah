@extends('layouting.guest.master')

@section('title', 'Tamabah Barang Keluar')
@section('content')
    <form action="{{ route('barang-keluar.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Detail Transaksi Barang Keluar</div>
                    </div>
                    <div class="card-body">
                        {{-- menampilkan validasi error --}}
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            {{-- input nomor kode cv --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Kode_cv">Nama Customer </label>
                                    <input type="text" class="form-control" id="Kode_cv" placeholder="Nama Customer"
                                        name="nama_customer" />
                                </div>
                            </div>
                            {{-- input tanggal --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        name="tanggal" />
                                </div>
                            </div>
                            {{-- input nomor polisi --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_polisi">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="no_polisi" placeholder="Nomor Polisi"
                                        name="no_polisi" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Detail Barang</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#productModal"
                                class="btn btn-primary">+ Tambah
                                Barang</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="ProductTable">
                            <thead>
                                <tr>
                                    <th class ="text-center">No</th>
                                    <th>Nama barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga Jual</th>
                                    <th>Subtotal</th>
                                    <th class ="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-action d-flex gap-2">
                        <button type="submit" class="btn btn-success w-50">Simpan</button>
                        <button type="button" class="btn btn-danger w-50">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Tambah -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Tambah Barang</h5>
                </div>
                <form id="ProductForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="barang">Nama Barang</label>
                                    <select class="form-select" name="barang" id="barang">
                                        <option selected disabled>--Pilih barang--</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}
                                                ({{ $barang->kode_barang }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Barang</label>
                                    <input type="number" class="form-control" id="jumlah" placeholder="Jumlah Barang" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option selected disabled>Pilih Satuan</option>
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="harga">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga" placeholder="Harga Jual" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var productIndex = 0;

        $(document).ready(function() {
            $("#ProductForm").on('submit', function(e) {
                e.preventDefault();

                var form = this

                var barang = $("#barang").val();
                var jumlah = parseInt($("#jumlah").val());
                var satuan = $("#satuan").val();
                var jumlahTotalBarang = 0;

                if (satuan == "kg") {
                    jumlahTotalBarang = jumlah;
                } else if (satuan == "ton") {
                    jumlahTotalBarang = jumlah * 1000;
                }

                var harga = parseFloat($("#harga").val());
                var subtotal = jumlahTotalBarang * harga;


                getProductById(barang, function(response) {
                    var namaBarang = response;

                    // Masukkan ke dalam table
                    productIndex++;

                    var tableRow = `
                        <tr>
                            <td>${productIndex}</td>
                            <td>
                                ${namaBarang}
                                <input type="hidden" name="barang[]" value="${barang}">
                            </td>
                            <td>
                                ${jumlah}
                                <input type="hidden" name="jumlah[]" value="${jumlah}">
                            </td>
                            <td>
                                ${satuan}
                                <input type="hidden" name="satuan[]" value="${satuan}">
                            </td>
                            <td>
                                ${formatToRupiah(harga)}
                                <input type="hidden" name="harga[]" value="${harga}">
                            </td>
                            <td>${formatToRupiah(subtotal)}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm delete-row">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    $("#ProductTable tbody").append(tableRow);

                    form.reset()
                    $('#productModal').modal('hide');
                });

            })

            $('#ProductTable').on('click', '.delete-row', function() {
                $(this).closest('tr').remove();
                updateTableNumbering();
            });

            function updateTableNumbering() {
                productIndex = 0;
                $('#ProductTable tbody tr').each(function(i) {
                    productIndex = i + 1;
                    $(this).find('td:first').text(productIndex);
                });
            }
        })

        function getProductById(id, callback) {
            $.ajax({
                url: `/barang/${id}/find`,
                type: 'GET',
                success: function(response) {
                    callback(response.nama_barang)
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            })
        }

        function formatToRupiah(amount) {
            return amount.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
            });
        }
    </script>
@endpush
