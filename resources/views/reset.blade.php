<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build your dream home</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/login-stylesheet.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('css/reset-stylesheet.css')}}"/>
  </head>
    <body>
	 <div class="overlay">
     </div>
     <div class="container">
        <div class="item1">
          <h1>FIRST MONARCHY</h1>
        </div>
        <div class="item3">
          <h3 class="tagline">VALLEY OF KINGS</h3>
        </div>
        <div class="item2">
          <button class="menuClosed">Menu &#9776;</button>
        </div>
		<div class="item4">
            <button class="menuOpen">&#10060;</button>
            <a class="navigationlink" title="About page" href="/about">About</a>
            <a class="navigationlink" title="Homepage" href="/">Home</a>
            <a class="navigationlink" title="Contact page" href="/contact">Contact</a>
	    </div>
		 <div class="item5">
		    <form id="login" class="loginform" method="POST" action="{{ route('password.email') }}">
          @csrf
      <div class ="formHeader">
          <h2>RESET PASSWORD</h2>
      </div>
              @if (session('status'))
                  <div class="success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif
			 <div>
			    <div class="input">
				           <label for="email">Email</label><input id="email" class="@error('email') is-invalid @enderror" type="email" size="25" name="email" value="{{old('email') }}" placeholder="Email address" autocomplete="email" autofocus required>
				   </div>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
                   </div>
               <input id="submitButton" type="submit" value="Send Password Reset Link">

			</form>
    </div>
		 </div>

   <script src="{{asset('js/login.js')}}"></script>
   </body>
</html>
