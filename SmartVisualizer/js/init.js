/*-----------------------------------------------------------------------------------
/*
/* Init JS
/*
-----------------------------------------------------------------------------------*/

 jQuery(document).ready(function() {

	 Highcharts.setOptions({
            global: {
                useUTC: false
            }
	});
	$('#stats').click()
	$('#appdata').click()
	$('#dropdown').ddslick({
    width: 300,
    imagePosition: "left",
    selectText: "Select Contest Week",
    onSelected: function (data) {
        console.log(data);
    }
});

	
	
/*----------------------------------------------------*/
/*	Flexslider
/*----------------------------------------------------*/
   $('#intro-slider').flexslider({
      animation: 'fade',
      controlNav: false,
   });




/*----------------------------------------------------*/
/*	gmaps
------------------------------------------------------*/

   var map;

   // main directions
   map = new GMaps({
      el: '#map', lat: 19.130547, lng: 72.915897, zoom: 18, zoomControl : true,
      zoomControlOpt: { style : 'SMALL', position: 'TOP_LEFT' }, panControl : false, scrollwheel: false
   });

   // add address markers
   map.addMarker({ lat: 19.130547, lng: 72.915897, title: 'SEIL Lab',
   infoWindow: { content: '<p>Smart Energy Informatics lab</p>' } });

/*----------------------------------------------------*/
/*	contact form
------------------------------------------------------*/

   $('form#contactForm button.submit').click(function() {

      $('#image-loader').fadeIn();

      var contactName = $('#contactForm #contactName').val();
      var contactEmail = $('#contactForm #contactEmail').val();
      var contactSubject = $('#contactForm #contactSubject').val();
      var contactMessage = $('#contactForm #contactMessage').val();

      var data = 'contactName=' + contactName + '&contactEmail=' + contactEmail +
               '&contactSubject=' + contactSubject + '&contactMessage=' + contactMessage;

      $.ajax({

	      type: "POST",
	      url: "inc/sendEmail.php",
	      data: data,
	      success: function(msg) {

            // Message was sent
            if (msg == 'OK') {
               $('#image-loader').fadeOut();
               $('#message-warning').hide();
               $('#contactForm').fadeOut();
              $( "#message-success" ).fadeIn();   
            }
            // There was an error
            else {
               $('#image-loader').fadeOut();
               $('#message-warning').html(msg);
	            $('#message-warning').fadeIn();
            }

	      }

      });

      return false;

   });

   // var jsonData = {
   //  "categories":["TotalPower","PCPower","PeakPower"],
   //  "week":1,
   //  "date":"22/03/2014",
   //  "data":[
   //          {
   //              "lab":"lab1",
   //              "values": [49.9, 71.5, 106.4]
    
   //          },
   //          {
   //              "lab":"lab2",
   //              "values": [32.9, 12.5, 601.4]
    
   //          },
   //          {
   //              "lab":"lab3",
   //              "values": [49.9, 71.5, 106.4]
    
   //          }
   //  ] 
   // };




});








