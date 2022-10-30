@extends('templates.master')

@section('title', 'Kategori')
@section('pwd', 'Kategori')
@section('sub-pwd', 'Kategori')

@section('content')
<div class="row g-3 row-deck render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('assets/functions/kategori/main.js')}}"></script>
    <script>
        function assets(url) {
            var url = '{{ url("") }}/' + url;
            return url;
        }
    </script>
@endpush