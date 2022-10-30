@extends('templates.master')

@section('title', 'Pemasok')
@section('pwd', 'Pemasok')
@section('sub-pwd', 'Pemasok')

@section('content')
<div class="row g-3 row-deck render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('assets/functions/pemasok/main.js')}}"></script>
    <script>
        function assets(url) {
            var url = '{{ url("") }}/' + url;
            return url;
        }
    </script>
@endpush