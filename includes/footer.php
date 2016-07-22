<footer>
<?/*?>
	<!-- footer -->
	<div class="footer">
    <div class="container">
	<div class="col-md-4 footer-left">
	<h6>THIS LOOKS GREAT</h6>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt consectetur adipisicing elit,</p>
	</div>
	<div class="col-md-4 footer-middle">
	<h4>Twitter Feed</h4>
	<div class="mid-btm">
	<p>Consectetur adipisicing</p>
	<p>Sed do eiusmod tempor</p>
	<a href="https://w3layouts.com/">https://w3layouts.com/</a>
	</div>
	
	<p>Consectetur adipisicing</p>
	<p>Sed do eiusmod tempor</p>
	<a href="https://w3layouts.com/">https://w3layouts.com/</a>
	
	</div>
	<div class="col-md-4 footer-right">
	<h4>Quick Links</h4>
	<li><a href="#">Eiusmod tempor</a></li>
	<li><a href="#">Consectetur </a></li>
	<li><a href="#">Adipisicing elit</a></li>
	<li><a href="#">Eiusmod tempor</a></li>
	<li><a href="#">Consectetur </a></li>
	<li><a href="#">Adipisicing elit</a></li>
	</div>
	<div class="clearfix"></div>
    </div> 
</div><?*/?>
<!-- footer -->
<!-- footer-bottom -->
<div class="foot-nav">
    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
				$PagesQuery = mysql_query("SELECT * FROM r_page order by id_page desc")or die(mysql_error());
				while ($page = mysql_fetch_assoc($PagesQuery)) {
				?>
                <li><a href="page.php?id=<?php echo $page['id_page']; ?>"><?php echo $page['title']; ?></a></li>
			<?php } ?>
            <li><a href="contact.php">Contact</a></li>
            <div class="clearfix"></div>
		</ul>
	</div>
</div>
<!-- footer-bottom -->
<div class="copyright">
    <div class="container">
        <p>© 2016 WWW.TECHDEFEAT.COM All rights reserved </p>
	</div>
</div>
</footer>
</body></html>

<script>
$(window).scroll(function(e){ 
  var $el = $('.head-bottom'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 150 && !isPositionFixed){ 
    $('.head-bottom').css({'position': 'fixed', 'top': '0px'}); 
  }
  if ($(this).scrollTop() < 150 && isPositionFixed)
  {
    $('.head-bottom').css({'position': 'static', 'top': '0px'}); 
  } 
});
</script>