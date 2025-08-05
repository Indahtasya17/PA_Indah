@extends('layouting.guest.master')

@section('title', 'Konfirmasi')
@section('content')

    <form action="{{ route('konfirmasi.store', $id) }}" method="POST">

        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Detail Informasi Dari Pelabuhan</div>
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
                                    <x-form-label for="tanggal" :required="true">Tanggal</x-form-label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" />
                                </div>
                            </div>

                            {{-- input status --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <x-form-label for="status" :required="true">Status</x-form-label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="diterima">Diterima</option>
                                        <option value="tidak sesuai">Tidak Sesuai</option>
                                    </select>
                                </div>
                            </div>

                            {{-- input keterangan --}}
                            <div class="col-12" id="keterangan-container" style="display: none;">
                                <div class="form-group">
                                    <x-form-label for="keterangan" :required="true">Keterangan</x-form-label>
                                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#status').on('change', function() {
                if ($(this).val() === 'tidak sesuai') {
                    $('#keterangan-container').show();
                } else {
                    $('#keterangan-container').hide();
                }
            });
        });
    </script>
@endpush
