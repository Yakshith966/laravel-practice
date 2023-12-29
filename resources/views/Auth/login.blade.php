<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
</head>
  
  <body>
    <section class="container">
      <header>Login Page</header>
      <form action="{{route('login-user')}}" class="form" method="POST">
        @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
            
        @endif 
        @if (Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
            
        @endif 
        @csrf

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" placeholder="Enter email address"  name="email" value="{{old('email')}}"/>
          <span class="text-danger">@error('email'){{$message}}
              
            @enderror</span>
        </div>

        <div class="column">
            <div class="input-box">
              <label>Password</label>
              <input type="password" placeholder="Enter password"  name="password" value="{{old('password')}}"/>
              <span class="text-danger">@error('password'){{$message}}
              
                @enderror</span>
            </div>
          </div>
        <button type="submit">Login</button>
        <button type="submit">New User! <a href="/signup">Register</a></button>
        
      </form>
      
    </section>
  </body>
</html>