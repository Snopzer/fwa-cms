<!-- display alexa rank-->
<div class="blo-top">
	<?php
		/*echo alexa_rank('jaancari.com');
			function alexa_rank($url){
			$xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=jaancari.com");
			if(isset($xml->SD)):
			return $xml->SD->REACH->attributes();
			endif;
		}*/
	?>
    <div class="tech-btm">
        <h5>Report us Tech defeat</h5>
        <p>write issues and Enhancement</p>
		<div class="button">
			<i class="fa fa-bus" aria-hidden="true"></i><a target="_blank" href="https://github.com/Snopzer/techdefeat/issues"><input type="submit" value="Write to Us"></a>
		</div>
        <div class="clearfix"> </div>
	</div>
</div>
<!-- display alexa rank-->
<div class="blo-top">
    <div class="tech-btm">
        <h5>Subscribe To Our Newsletter</h5>
        <p>Signup and Get Connected with us</p>
		<span id="showMessage"></span>
		<div id="SubscibeNow">
			<form id="SubscriptionFrom">
				<div class="name">
					<input type="text" name="email" id="email" placeholder="Email" required="">
				</div>	
				<div class="button">
					<button id="Subscribe" class="btn btn-info">Subscribe Now</button>
				</div>
			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

<div class="blo-top">
	<div class="tech-btm">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Techdefeat Ad -1 -->
		<ins class="adsbygoogle"
		style="display:block"
		data-ad-client="ca-pub-9505794457801858"
		data-ad-slot="2227413920"
		data-ad-format="auto"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
</div>


<script type="text/javascript" language="JavaScript">
	$("#Subscribe").click(function()
	{
		$("#showMessage").html('');
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var email = $("#email").val();
		if((email=='') || (!regex.test(email)))
		{
			$("#email").css({"border-style": "solid", "border-color": "red"});
			$("#showMessage").html('Please Enter Valid Email');
			$("#email").focus();
			return false;
			}else{
			$("#email").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		$.ajax({
			url: "controller.php",
			method: "POST",
			data: { subscribeData : $("#SubscriptionFrom").serialize(), 'action':'newsletter'},
			dataType: "json",
			success: function (response) {
				if(response["success"]==true)
				{
					$("#showMessage").html('<div class="alert alert-success"><strong>Success!</strong> '+response['message']+'</div>');
					
					}else{
					$("#showMessage").html('<div class="alert alert-warning"><strong>warning!</strong> '+response['message']+'</div>');
				}
			},
			error: function (request, status, error) {
				$("#showMessage").html('<div class="alert alert-warning"><strong>warning!</strong> Please Try After Sometime!</div>');
			}
		});
		return false;
	});
</script>