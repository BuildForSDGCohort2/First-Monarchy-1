<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" initial-scale="1.0">
<link type= "text/css" rel="stylesheet" href="{{asset('css/contact-stylesheet.css')}}"/>
<title>First Monarchy-CONTACT</title>
</head>
 <body>
  <main>
  <div class="overlay">
  </div>
  <div class="container">
   <div class="item1">
    <h1>FIRST MONARCHY</h1>
   </div>
    <div class="item2">
     <h3>VALLEY OF KINGS</h3>
   </div>
   <div class="item3">
    <button class="menuClosed">Menu &#9776;</button>
   </div>
   <div class="item4">
     <h2 class="descriptor-text">SUBMIT YOUR QUERIES TO OUR CUSTOMER CARE TEAM</h2>
	 <p class="note">Contact us directly via email or phone</p>
   </div>
   <div class="item5">
     <p class="label">Email:<a class="address" href="mailto:dream@cdr.com">dream@cdr.com</a></p>
     <p class="label">Phone:<a class="address" href="tel:020-001-002">020-001-002</a></p>
   </div>
   <div class="item6">
        <button class="menuOpen">&#10060;</button>
        <a class="navigationlink" title="Home" href="/">Home</a>
        <a class="navigationlink" title="About Us" href="/about">About</a>
   </div>
   <div class="item7">
     <p class="note">Or fill in this contact form</p>
     <form id="Contact-form" class="Contactform" action="Contact.php" enctype="multipart/form-data" method="post" target="_self">
	    <input type="hidden" value="MAIN CONTACT PAGE">
        <div class="formtext">
            <div class="inputContainer">
                 <label for="Name">Name:</label><input id="Name" class="textfield" name="Name:" type="text" size="25" title="Enter your name" placeholder="Enter your name here" required>
			</div>
            <div class="inputContainer">
                 <label for="Email">Email:</label><input id="Email" class="textfield" name="Email:" type="email" size="25" title="Enter a valid email address" placeholder="Enter your Email here" required>
		    </div>
			<div class="textfieldContainer">
                 <label for="Description">Describe the issue or query you would want to raise with our customer care team:</label><textarea id="Description" class="textarea" name="Issue-description:" rows="5" cols="25" placeholder="Enter text here"></textarea>
            </div>
                <p class="SubmitContainer" ><input type="submit" class="submit" value="Submit"></p>
        </div>
     </form>
   </div>
  </div>
  </main>
  <script src="{{asset('js/contact.js')}}"></script>
 </body>
</html>
