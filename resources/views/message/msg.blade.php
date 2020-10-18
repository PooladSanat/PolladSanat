<!--sweet Alert-->
<script src="{{asset('/public/assets/sweetalert.js')}}"></script>
@if(session()->has('msg-success'))
    <script>
        Swal.fire({
            title: 'موفق',
            text: '{{session('msg-success')}}',
            icon: 'success',
            confirmButtonText: 'تایید',
        })
    </script>
@endif
@if(session()->has('msg-error'))
    <script>
        Swal.fire({
            title: 'خطا!',
            text: '{{session('msg-error')}}',
            icon: 'error',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
@if($errors->any())
    <script>
        Swal.fire({
            title: 'خطا!',
            @foreach($errors->all() as $error)
            text: '{{$error}}',
            @endforeach
            icon: 'error',
            confirmButtonText: 'تایید'
        })
    </script>
@endif
