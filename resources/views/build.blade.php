<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/build-stylesheet.css')}}"/>
 </head>
 <body>
   <div class="overlay">
   </div>
   <div class="container">
     <div class="item1">
       <h1 class="header">FIRST MONARCHY</h1>
     </div>
     <div class="item3">
       <h3 class="tagline">VALLEY OF KINGS</h3>
     </div>
     <div class="item2">
       <button class="menuClosed">Menu &#9776;</button>
     </div>
     <div class="item4">
         <h2>CHOOSE A BUILDING TYPE</h2>
     </div>
     <div class="item5">
       <button class="menuOpen">&#10060;</button>
       <a class="navigationlink" href="/">Home</a>
       <a class="navigationlink" href="/contact">Contact</a>
       <a class="navigationlink" href="/about">About</a>
     </div>
	 <div class="item6">
     <div class="linkContainer">
	     <div id="HomeCardOpener" class="cardlink"><button  class="buildlink">HOME</button></div>
       <div id="CommercialCardOpener" class="cardlink"><button  class="buildlink">COMMERCIAL</button></div>
    </div>
	 </div>
	 <div class="item7">
	     <div id="HomeCard" class="card">
           <h2>BUILD A HOME</h2>
           <p>The "Home" category includes Villas,Mansionettes,Mansions and other structures meant for residential,non-commercial use.</p>
			     <img class="descriptionImage" src="../images/apartment-ceiling.jpg">
           <div class="cardfooter">
			      <button class="closelink"  title="close">Close this window &#10060;</button>
            <a class="cardlink"  href="/choice"  title="Build a home">Proceed to build a home</a>
         </div>
        </div>
        <div id="CommercialCard"  class="card">
           <h2>COMMERCIAL BUILDING</h2>
           <p>The "Commercial" category includes buildings meant for commercial or public use such as Apartment blocks,Office blocks,Stadia,Auditoriums,etc</p>
				   <img class="descriptionImage" src="../images/real-estate.jpg">
           <div class="cardfooter">
           <button class="closelink"  title="close">Close this window &#10060;</button>
				   <a class="cardlink"  href="/choice"  title="Build a commercial structure">Proceed to commercials</a>
         </div>
        </div>
	 </div>
  </div>
  <script src="{{asset('js/build.js')}}"></script>
 </body>
</html>
