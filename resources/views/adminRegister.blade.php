<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build your dream home in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Register</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/register-stylesheet.css')}}"/>
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
		    <form id="login" class="loginform" method="POST" action="/register/admins" enctype="multipart/form-data">
          @csrf
      <div class ="formHeader">
          <h2>CREATE ADMIN</h2>
      </div>
			 <div>
			    <div class="input">
			        <label for="firstName">First Name</label><input id="first_name" type="text" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name" name="first_name" autocomplete="first_name" autofocus  required>
				</div>
				<div class="input">
				     <label for="lastName">Last Name</label><input id="last_name" type="text" class="@error('last_name') is-invalid @enderror"  value="{{ old('last_name') }}" name="last_name" autocomplete="last_name" placeholder="Last Name" required>
				</div>
                <div class="input">
				     <label for="email">Email</label><input id="email" type="email" name="email" class="@error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email address" autocomplete="email" required>
				</div>
       <div class="input">
         <label for="avatar">Avatar</label><input id="avatar" class="textfield" type="file"  name="avatar" title="avatar" required>
       </div>
        <div class="input">
                     <label for="password">Create password</label><input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Create password" autocomplete="new-password" required>
				</div>
        <div class="input">
                     <label for="confirmPassword">Confirm password</label><input id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password" required>
				</div>
			   </div>
           @if($errors->any())
           <div class="is-invalid">
             <ul>
           @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
              @endforeach
            </ul>
            </div>
            @endif
           <input id="submitButton" type="submit" value="CREATE ACCOUNT">
           <p>Already have an account ?<a class="crosslink" href="/login">LOG IN</a>
			</form>
		 </div>
	 </div>
   <script src="{{asset('js/register.js')}}"></script>
   </body>
</html>
