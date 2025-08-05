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
                            {{-- input nama customer --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <x-form-label for="Kode_cv" :required="true">Nama Customer</x-form-label>
                                    <input type="text" class="form-control" id="Kode_cv" placeholder="Nama Customer"
                                        name="nama_customer" required />
                                </div>
                            </div>

                            {{-- input tanggal --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="tanggal" :required="true">Tanggal</x-form-label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                                </div>
                            </div>

                            {{-- input nomor polisi --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="no_polisi" :required="true">Nomor Polisi Truk</x-form-label>
                                    <input type="text" class="form-control" id="no_polisi" name="no_polisi"
                                        placeholder="Nomor Polisi" required />
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
                                    <x-form-label for="barang" :required="true">Nama Barang</x-form-label>
                                    <select class="form-control" name="barang" id="barang" required>
                                        <option selected disabled>--Pilih barang--</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">
                                                {{ $barang->nama_barang }} ({{ $barang->kode_barang }}) (Stock:
                                                {{ $barang->stok }} Kg)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <x-form-label for="jumlah" :required="true">Jumlah Barang</x-form-label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah"
                                        placeholder="Jumlah Barang" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <x-form-label for="satuan" :required="true">Satuan</x-form-label>
                                    <select class="form-control" name="satuan" id="satuan" required>
                                        <option selected disabled>Pilih Satuan</option>
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <x-form-label for="harga" :required="true">Harga Jual</x-form-label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        placeholder="Harga Jual" required />
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    var namaBarang = response.nama_barang;
                    var stockBarang = response.stok;

                    // Periksa stok
                    if (stockBarang < jumlahTotalBarang) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Stok barang tidak mencukupi. Stock saat ini: ' + stockBarang + ' Kg',
                        });
                        return;
                    }

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

        // Fungsi untuk mendapatkan nama barang berdasarkan ID
        function getProductById(id, callback) {
            $.ajax({
                url: `/barang/${id}/find`,
                type: 'GET',
                success: function(response) {
                    callback(response)
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
