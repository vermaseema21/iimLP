
<?php include 'popup.php'; ?>

    <div id="footer">
    <div class="container">
    <div class="footer-section">
            <div class="footer-column">
                <img src="assets/img/white-iim-logo.webp" alt="logo-img" width="100%"/>
              
            </div>
            <div class="footer-column">
                <h2>Accreditaion</h2>
               
				<p>EQUIS : European Quality Improvement System</p>
				<p>AMBA : Association of MBAs</p>
            </div>
            <div class="footer-column">
                <h2>QUICK LINKS</h2>
                <p>About IIM - Kozikode</p>
                <p>Advantages</p>
                <p>FAQ</p>
                <br/>
            </div> 
        </div>
      
        <div class="doubt-section">
      <h2>Have Query? Need Guidance</h2>
 <center> <button class="enquireNowBtn">Enquire Now</button></center>
    </div>
     
    </div>
</div>


<div id="footer-bottom-bar">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
            <!--<p>Home | About | Courses | FAQ</p>-->
            <center><hr/></center>
            <p>&copy; <?php echo date("Y"); ?> IIM Kozhikode Online University - All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>

<script>
//     start on scroll popup

  window.addEventListener('scroll', function () {
    const scrollableHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrolledPercentage = (window.scrollY / scrollableHeight) * 100;

    if (scrolledPercentage >= 50) {
      const modal = document.getElementById('myModal');
      modal.style.display = 'flex';
      window.removeEventListener('scroll', arguments.callee);
    }
  });

  document.getElementById('closeButton').addEventListener('click', function () {
    const modal = document.getElementById('myModal');
    modal.style.display = 'none';
  });
    </script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" async></script>

        <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Function to get the value of a URL parameter
        function getQueryParam(param) {
            var searchParams = new URLSearchParams(window.location.search);
            return searchParams.get(param) || ''; // Return an empty string if the parameter is not found
        }

        // Get all forms on the page
        var forms = document.querySelectorAll('form');

        // Loop through each form to set the values
        forms.forEach(function(form) {
            form.querySelector('#sub_source').value = getQueryParam('sub_source');
            form.querySelector('#utm_source').value = getQueryParam('utm_source');
            form.querySelector('#utm_campaign').value = getQueryParam('utm_campaign');
            form.querySelector('#utm_medium').value = getQueryParam('utm_medium');
            form.querySelector('#utm_term').value = getQueryParam('utm_term');

            // Get the current URL
            const currentURL = window.location.href;

            // Remove UTM parameters and fragments from the URL
            const urlWithoutParams = currentURL.split(/[?#]/)[0];

            // Set the extracted URL to the input field
            form.querySelector('#page_url').value = urlWithoutParams;
        });
    });
</script>