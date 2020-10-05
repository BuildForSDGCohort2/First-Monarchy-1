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
		    <form id="login" class="loginform" method="POST" action="/register/agents" enctype="multipart/form-data">
          @csrf
      <div class ="formHeader">
          <h2>CREATE AGENT ACCOUNT</h2>
      </div>
			 <div>
			    <div class="input">
			        <label for="name">Name</label><input id="name" type="text"  value="{{ old('name') }}" placeholder="Name" name="name" class="@error('name') is-invalid @enderror" autocomplete="name" autofocus  required>
				</div>
				<div class="input">
				     <label for="bio">Bio</label><textarea id="bio" type="text" class="@error('bio') is-invalid @enderror"  value="{{ old('bio') }}" name="bio"  placeholder="Bio" required></textarea>
				</div>
                <div class="input">
				     <label for="email">Email</label><input id="email" type="email" name="email" class="@error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email address" autocomplete="email" required>
				</div>
                <div class="input">
				     <label for="phone_number">Phone Number</label><input id="phone_number" type="text" class="@error('phone_number') is-invalid @enderror"  value="{{ old('phone_number') }}" name="phone_number" placeholder="Phone Number" autocomplete="phone_number" required>
				</div>
        <div class="input">
          <label for="country_code">Country</label>
               <select  id="country_code" type="number" name="country_code"  class="@error('country_code') is-invalid @enderror" required>
                   <option value="+254">Kenya</option>
               </select>
       </div>
       <div class="input">
    <label for="logo">Logo</label><input id="avatar" type="file" accept="image/*" name="logo" class="@error('avatar') is-invalid @enderror"  value="{{ old('logo') }}" required>
</div>
        <div class="input">
                     <label for="password">Create password</label><input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Create password" autocomplete="new-password" required>
				</div>
        <div class="input">
                     <label for="confirmPassword">Confirm password</label><input id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password" required>
				</div>
			   </div>
         @error('name')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @error('bio')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @error('email')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @error('country_code')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @error('phone_number')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
         @error('password')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
         @enderror
                     <input id="submitButton" type="submit" value="CREATE ACCOUNT">
                     <p>Already have an account ?<a class="crosslink" href="/login/agents">LOG IN</a>
			</form>
		 </div>
	 </div>
   <script src="{{asset('js/register.js')}}"></script>
   </body>
</html>
