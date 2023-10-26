<div>
    @if (session('success'))
    <div style="color: green">
    {{session('success')}}
    </div>
        
    @endif
    @if (session('error'))
    <div style="color: red">
    {{session('error')}}
    </div>
        
    @endif
    <form action="{{route('otp-entry')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <label for="">OTP</label>
        <br>
        <input type="text" name="otp" value="{{old('otp')}}" required placeholder="Enter OTP">
        @error('otp')
        <strong style="color: red">
            {{$message}}
        </strong>
            
        @enderror
        <button type="submit">submit</button>
    </form>
</div>