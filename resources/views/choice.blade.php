<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width" initial-scale="1.0">
   <meta name="description" content="Build a dream home,workspace or Public utility in a photorealistic online environment">
   <meta name="keywords" content="First Monarchy,build,dream,home">
   <title>First Monarchy-Build</title>
   <link rel="stylesheet" type="text/css" href="{{asset('css/choice-stylesheet.css')}}"/>
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
       <button class="menuClosed">Menu  &#9776;</button>
     </div>
     <div class="item4">
         <h2>WHAT DO YOU PREFER ?</h2>
     </div>
     <div class="item5">
       <button class="menuOpen">&#10060;</button>
       <a class="navigationlink" href="/">Home</a>
       <a class="navigationlink" href="/contact">Contact</a>
       <a class="navigationlink" href="/about">About</a>
     </div>
	 <div class="item6">
     <div class="linkContainer">
	     <div id="HomeCardOpener" class="cardlink"><button class="buildlink">CUSTOMIZE A BUILDING PLAN</button></div>
       <div id="CommercialCardOpener" class="cardlink"><button class="buildlink">MEET AN ARCHITECT</button></div>
    </div>
	 </div>
	 <div class="item7">
	     <div id="HomeCard" class="card">
          <h2>CUSTOMIZE A READY-MADE BUILDING PLAN</h2>
          <p>You will be directed to our catalogue of ready-made building plans,which you can customize by adding furniture and furnishings from the Monarchy Store then buy.After site visits and approval of the construction site,construction work shall begin.</p>
          <img class="descriptionImage" src="../images/floor-plan.jpg">
          <div class="cardfooter">
			      <button class="closelink"  title="close">close this window &#10060;</button>
            <a class="cardlink" title="proceed to building plans" href="/categories">Proceed to building plans &#10003;</a>
         </div>
        </div>
        <div id="CommercialCard"  class="card">
           <h2>MEET ONE OF OUR ARCHITECTS</h2>
           <p>A meeting will be scheduled with one of our architects where you shall discuss design and other aspects of your home .The design you agree upon shall be uploaded to your First Monarchy account,and you can customize it by adding furniture and decor from the Monarchy Store.After site visits and approval of the construction site,construction work shall begin. </p>
           <img class="descriptionImage" src="../images/meeting.jpg">
           <div class="cardfooter">
            <button class="closelink"  title="close">close this window &#10060;</button>
				    <a class="cardlink" title="schedule a meeting with an architect" href="/ea">Schedule meeting &#10003;</a>
          </div>
        </div>
	 </div>
  </div>
  <script src="{{asset('js/choice.js')}}"></script>
 </body>
</html>
