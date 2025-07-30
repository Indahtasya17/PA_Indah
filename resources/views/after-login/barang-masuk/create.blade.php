@extends('layouting.guest.master')

@section('title', 'Tambah Barang Masuk')
@section('content')
    <form action="{{ route('barang-masuk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Transaksi Data Barang Masuk</div>
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

                        {{-- input tanggal --}}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" />
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

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_invoice">No Invoice</label>
                                    <input type="text" class="form-control" id="no_invoice" name="no_invoice"
                                        placeholder="Nomor Invoice" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="text" class="form-control" id="kontak_supir" placeholder="Kontak"
                                        name="kontak_supir" />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nota">File Nota</label>
                                    <input type="file" class="form-control" required id="file" name="file_upload"
                                        placeholder="nota" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- detail barang --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Barang</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#productModal"
                                class="btn btn-md btn-primary">+ Tambah
                                Barang</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        {{-- Tabel untuk menampilkan barang dari tabel modal --}}
                        <table class="table" id="ProductTable">
                            <thead>
                                <tr>
                                    <th class ="text-center">No</th>
                                    <th>Nama barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga Beli</th>
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

        {{-- Tombol Aksi --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-action d-flex gap-2">
                        <button type="submit" class="btn btn-success w-50">Simpan</button>
                        <button class="btn btn-danger w-50">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="ProductForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="barang">Nama Barang</label>
                                    <select class="form-control" name="barang" id="barang">
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
                                    <input type="number" class="form-control" id="jumlah"
                                        placeholder="Jumlah Barang" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-control" name="satuan" id="satuan">
                                        <option selected disabled>Pilih Satuan</option>
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="harga">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga"
                                        placeholder="Harga Beli" />
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

        $(document).ready(function() {
            // Add new row
            $('#fileRepeater').on('click', '.btn-add', function() {
                var currentRow = $(this).closest('.repeater-item');
                var newRow = currentRow.clone();

                // Bersihkan nilai input
                newRow.find('input').val('');
                $('#fileRepeater').append(newRow);
            });

            // Remove row
            $('#fileRepeater').on('click', '.btn-remove', function() {
                var totalItems = $('.repeater-item').length;
                if (totalItems > 1) {
                    $(this).closest('.repeater-item').remove();
                } else {
                    alert("Minimal satu input harus ada.");
                }
            });


        });
    </script>
@endpush
