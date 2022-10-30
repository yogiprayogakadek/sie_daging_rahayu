@extends('templates.master')

@section('title', 'Staff')
@section('pwd', 'Staff')
@section('sub-pwd', 'Staff')

@section('content')
<div class="row g-3 row-deck render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('assets/functions/staff/main.js')}}"></script>
    <script>
        function assets(url) {
            var url = '{{ url("") }}/' + url;
            return url;
        }
    </script>
@endpush