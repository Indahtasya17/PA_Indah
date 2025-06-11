@props(['id' => 'basic-datatables'])

<div class="table-responsive">
    <table id="{{ $id }}" class="display table table-striped table-hover">
        <thead>
            {{ $tableHead }}
        </thead>
        <tfoot>
            {{ $tableHead }}
        </tfoot>
        <tbody>
            {{ $tableBody }}
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#{{ $id }}").DataTable({});
        });
    </script>
@endpush
