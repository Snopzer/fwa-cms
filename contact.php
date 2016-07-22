<?php 
	
	
	$metaArray = array(
    "title"  => 'Contact us',
    "meta-keywords" => 'contact techdefeat, ask your questions, need support at your work.?',
    "meta-description" => 'Share your Work, we give you support at your technical problems, contact us for more details',
	);
	include_once('admin/includes/config.php');
	include_once('includes/header.php'); 
	?>
<div class="banner1">
</div>
<div class="technology-1">
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="business">
                <div id="contact" class="contact">
                    <h3>Contact</h3>		
                    <div class="contact-grids">
                        <div class="contact-icons">
                            <div class="contact-grid">
                                <div class="contact-fig">
                                    <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                </div>
                                <p>+91 7207556743<br />
                                +91 8332045764<br />
                                +91 7207556743</p>
                            </div>
                            <div class="contact-grid">
                                <div class="contact-fig1">
                                    <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                </div>
                                <p>H No : 10-1-601/19,
                                    <span>Khairathabad, Hyderabad, 500002</span></p>
                            </div>
                            <div class="contact-grid">
                                <div class="contact-fig2">
                                    <span class="glyphicon glyphicon-envelope2" aria-hidden="true"></span>
                                </div>
                                <p><a href="mailto:steman.fareed@gmail.com">steman.fareed@gmail.com</a><br />
                                <a href="mailto:Mohammadwaheed567@gmail.com">Mohammadwaheed567@gmail.com</a><br />
                                <a href="mailto:abidali70722@gmail@gmail.com">abidali70722@gmail.com</a></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <form action="controller.php?action=contact" method="post">
                            <input type="text" name="subject" id="subject" placeholder="Subject">
                            <input type="text" name="name" id="name" placeholder="Enter Your Name">
                            <input type="text" name="email" id="email" placeholder="Enter A valid Email Address">
                            <textarea name='message' id="message" placeholder=" Type Your Message..."></textarea>
                            <input type="submit" id="contactForm" value="SUBMIT">
                        </form>
                    </div>	
                </div>
            </div>
        </div>
        <!-- technology-right -->
        <div class="col-md-3 technology-right-1">
            <div class="blo-top">
                <div class="tech-btm">
                    <img src="images/banner1.jpg" class="img-responsive" alt=""/>
                </div>
            </div>            
            <?php include_once('includes/subscribe.php'); ?>
            <?php include_once('includes/users.php'); ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
$("#contactForm").click(function ()
    {
        if ($("#subject").val() == '')
        {
            $("#subject").css({"border-style": "solid", "border-color": "red"});
            $("#subject").focus();
            return false;
        }else{
         $("#subject").css({"border-style": "solid", "border-color": "green"});   
        }
        if ($("#name").val() == '')
        {
            $("#name").css({"border-style": "solid", "border-color": "red"});
            $("#name").focus();
            return false;
        }else{
            $("#name").css({"border-style": "solid", "border-color": "green"});
        }
        var email = $("#email").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ((email == '') || (!regex.test(email)))
        {
            $("#email").css({"border-style": "solid", "border-color": "red"});
            $("#email").focus();
            return false;
        }else{
            $("#email").css({"border-style": "solid", "border-color": "green"});
        }     
        if ($("#message").val() == '')
        {
            $("#message").css({"border-style": "solid", "border-color": "red"});
            $("#message").focus();
            return false;
        }
        else{
            $("#message").css({"border-style": "solid", "border-color": "green"}); 
        }
    });
</script>
<?php include_once('includes/footer.php'); ?>