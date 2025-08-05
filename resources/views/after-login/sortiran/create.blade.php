@extends('layouting.guest.master')

@section('title', 'Tambah Sortiran')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Barang Sortiran</div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('sortiran.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="barang">Nama Barang <span class="text-danger">*</span></label>
                                    <select class="form-select" name="id_barang" id="barang" required>
                                        <option selected disabled>--Pilih barang--</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}
                                                ({{ $barang->kode_barang }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_sortiran">Jumlah Sortiran <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="jumlah_sortiran" name="jumlah_sortiran"
                                        placeholder="Jumlah Sortiran" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-select" name="satuan" id="satuan">
                                        <option value="kg">Kg</option>
                                        <option value="ton">Ton</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_busuk">Jumlah Rusak <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="jumlah_busuk" name="jumlah_busuk"
                                        placeholder="Jumlah Rusak" required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_bagus">Jumlah Bagus</label>
                                    <input type="number" class="form-control" id="jumlah_bagus" name="jumlah_bagus"
                                        placeholder="Jumlah Bagus" readonly />
                                </div>
                            </div>
                            
                        </div>

                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" a href="{{ url()->previous() }}" class="btn btn-danger">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function hitungJumlahBagus() {
            const sortiran = parseInt(document.getElementById('jumlah_sortiran').value) || 0;
            const rusak = parseInt(document.getElementById('jumlah_busuk').value) || 0;
            const hasil = sortiran - rusak;
            document.getElementById('jumlah_bagus').value = hasil >= 0 ? hasil : 0;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('jumlah_sortiran').addEventListener('input', hitungJumlahBagus);
            document.getElementById('jumlah_busuk').addEventListener('input', hitungJumlahBagus);
        });
    </script>
@endpush
