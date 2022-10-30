@extends('templates.master')

@section('title', 'Produk')
@section('pwd', 'Produk')
@section('sub-pwd', 'Produk')

@section('content')
<div class="row g-3 row-deck render">
    {{--  --}}
</div>
@endsection

@push('script')
    {{-- <script src="{{asset('assets/functions/main.js')}}"></script> --}}
    <script src="https://spruko.com/demo/sash/sash/assets/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('assets/functions/produk/main.js')}}"></script>
    <script src="{{asset('assets/functions/main/main.js')}}"></script>
    <script>
        function assets(url) {
            var url = '{{ url("") }}/' + url;
            return url;
        }
    </script>
@endpush