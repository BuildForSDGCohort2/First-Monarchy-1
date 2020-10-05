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
		    <form id="login" class="loginform" method="POST" action="/register/companies" enctype="multipart/form-data">
          @csrf
      <div class ="formHeader">
          <h2>CREATE COMPANY ACCOUNT</h2>
      </div>
			 <div>
			    <div class="input">
			        <label for="name">Company Name</label><input id="name" type="text" class="@error('first_name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" name="name" autocomplete="first_name" autofocus  required>
				</div>
				<div class="input">
				     <label for="bio">Company Bio</label><textarea id="bio" type="text" class="textarea @error('bio') is-invalid @enderror"  value="{{ old('bio') }}" name="bio"  placeholder="bio" required>{{ old('bio') }}</textarea>
				</div>
        <div class="input">
				     <label for="email">Company Email</label><input id="email" type="email" name="email" class="@error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email address" autocomplete="email" required>
				</div>
        <div class="input">
				     <label for="phone">Company Phone</label><input id="phone" type="text" class="@error('phone') is-invalid @enderror"  value="{{ old('phone') }}" name="phone" placeholder="Phone Number" autocomplete="phone" required>
				</div>
        <div class="input">
				     <label for="address">Company Address</label><input id="address" type="text" class="@error('address') is-invalid @enderror"  value="{{ old('address') }}" name="address" placeholder="address" required>
				</div>
        <div class="input">
				    <label for="logo">Company Logo</label><input id="logo" type="file" class="@error('logo') is-invalid @enderror"  value="{{ old('logo') }}" name="logo" placeholder="Logo" required>
				</div>
        <fieldset class="categories">
          <legend>Type of services offered</legend>
          @foreach(App\Category::all() as $category)
          <div class="input remember">
               <label for="{{$category->name}}">{{$category->name}}<input id="{{$category->name}}" class="companytypecheckbox" type="checkbox" name="category[]"  value="{{$category->id}}"><span class="new-checkbox"></span></label>
          </div>
          @endforeach
        </fieldset>
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
            <li class="invalid-feedback">{{$error}}</li>
             @endforeach
           </ul>
           </div>
           @endif
         <input id="submitButton" type="submit" value="CREATE ACCOUNT">
         <p>Already have an account ?<a class="crosslink" href="/login/companies">LOG IN</a>
			</form>
		 </div>
	 </div>
   <script src="{{asset('js/register.js')}}"></script>
   </body>
</html>
