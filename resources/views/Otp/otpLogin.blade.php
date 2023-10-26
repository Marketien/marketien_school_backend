<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Otp-Auth</title>
</head>
<body>
    <div>
        <h1>
            Otp with mobile
        </h1>
        @if (session('error'))

        <div style="color:red">
            {{session('error')}}
        </div>
            
        @endif
        <form action="{{route('otp-generate')}}" method="POST">
         @csrf
        <label>Enter Mobile Number</label>
        <br>
        <input type="text" name="mobileNo" value="{{old('mobileNo')}}" required placeholder="enter number">
        <br>
        @error('mobileNo')
        <strong style="color: red">
         {{$message}}
        </strong>
            
        @enderror
        <br>
        <button type="submit">Generate OTP</button>
        </form>
    </div>
    
</body>
</html>