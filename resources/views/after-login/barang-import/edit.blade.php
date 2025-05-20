@extends('layouting.guest.master')

@section('content')
    <form action="{{ route('barang-import.masuk.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Transaksi Data Barang Masuk</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nopol">Nomor Polisi</label>
                                    <input type="text" class="form-control" id="nopol" placeholder="Nomor Polisi" name="nopol" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" name="tanggal_masuk"/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="nomor_invoice">Nomor Invoice</label>
                                    <input type="text" class="form-control" id="nomor_invoice"
                                        placeholder="Nomor Invoice" name="no_invoice"/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="no_container">Nomor Container</label>
                                    <input type="text" class="form-control" id="no_container"
                                        placeholder="Nomor Container" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Barang</h4>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#productModal"
                                class="btn btn-md btn-primary">Tambah
                                Barang</button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="ProductTable">
                            <thead>
                                <tr>
                                    <th class ="text-center">No</th>
                                    <th>Nama barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
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
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail File</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="fileRepeater">
                            <div class="row repeater-item mb-3 gx-0">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="file_name">Nama File</label>
                                        <input type="text" class="form-control" name="file_names[]"
                                            placeholder="Nama File" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" name="files[]" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 d-flex align-items-center justify-content-center">
                                    <div class="d-flex gap-2 mt-4">
                                        <button type="button" class="btn btn-sm btn-primary btn-add">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger btn-remove">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <h5 class="modal-title" id="productModalLabel">Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="ProductForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="barang">Barang</label>
                                    <select class="form-select" name="barang" id="barang">
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Berat</label>
                                    <input type="number" class="form-control" id="jumlah"
                                        placeholder="Jumlah Berat" value="1"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga"
                                        placeholder="Harga Barang" value="1"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
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
                                ${harga}
                                <input type="hidden" name="harga[]" value="${harga}">
                            </td>
                            <td>${subtotal}</td>
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
