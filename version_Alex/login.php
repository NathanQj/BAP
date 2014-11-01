<?php
ob_start();

include("config/config.php");
include("modules/mysql/action/mysqlcon.php");
include("constant.php");


if(isset($_SESSION['_frontUserInfo']['i_autocode']))
{
	//header("location:home.php");
	//die();
}


ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("head.php"); ?>
<script>
	$(document).ready(function(){
		$('#msgMail').hide();
		$('#envoyerOubliMail1').click(function(){
			if($('#youremail').val().length==0)
				return;
			$.ajax({
				type:'POST',
			    url:'modules/login/action/retrievepwd.php',
			    data: {email:$('#youremail').val()},
			    error: function()
			    {
			        //file not exists
			    },
			    success: function()
			    {
			    	$('#msgMail').show();
			    	setTimeout(function(){
			    		$('#fermeture').trigger("click");
			    		$('#formMail').show();
			    		$('#msgMail').hide();
			    	},2000);
			    }
			});
		});
		
		
	});
</script>
</head>
<body>
	<div class="overlay">	
	</div>	
	<div class="mot_passe_oublie" name="mot_passe_oublie" id="mot_passe_oublie">
		<div><a href="javascript:void(0);"><img id="fermeture" src="ressources/images/croix_fermeture.png"></a></div>
		
		<span id="formMail">
		Vous avez oublié votre mot de passe.<br>
		Merci de saisir votre adresse mail :<br>
		<input type="text" value="" id="youremail">
		<input type="submit" value="Envoyer" id="envoyerOubliMail1">
		</span>
		<span id="msgMail"><br/><br/>Vous allez recevoir vos informations de connexion par mail!</span>
	</div>
			
	<div class="main-pre">
			<img class="logo pre-home" src="ressources/images/logo.png">
			<div class="slider">
				<img class="slider-img" src="ressources/images/slider1.png">
				<img class="slider-img" src="ressources/images/slider2.png">
				<img class="slider-img" src="ressources/images/slider3.png">
			</div>
				<div class="connexion">
					<div class="inscrit">
						<span>Vous avez deja un compte ? <strong> Connectez-vous.</strong></span>
						<form name="login">
							<div class="error">Email ou mot de passe érroné </div>
							<input type="text" name="email" placeholder="Adresse e-mail">
							<input type="password" name="pass" placeholder="Mot de passe">
							<input type="submit" value="Connexion">
							<input type="checkbox" name="keep-active" value="yes" id="keep-active" >
							<label for="keep-active" class="check-style">Garder ma session</label>
							<a href="javascript:void(0);" onclick="ouverture();" style="font-size:11px;color:#fff;position: relative;top: 0;left: -4px;text-decoration: underline;">Mot de passe oubli&eacute;</a>
						</form>
					</div>
					<div class="pas-inscrit">
						<p>Inscrivez-vous, c'est gratuit.</p>
						<p class="inscription">Rejoignez CUSTORIAL, cela vous prendra moins de 2 minutes pour ouvrir un compte.</p>
						<!-- fb connect -->
						<img src="ressources/images/facebook.png" onclick="Login()" style="width: 100%; margin: 10px 0 18px 0;  cursor: pointer;">
						<div class="trait"><span>OU</span></div>
						<span> Cr&eacute;er un compte avec votre adresse email</span>
						<form name="register">
							<div class="error2">Informations fausse ou adresse email d&eacute;j&agrave; utilis&eacute;</div>
							<input type="text" placeholder="Vous &ecirc;tes..." name="status">
							<input type="text" placeholder="Pr&eacute;nom et nom" name="nom">
							<input type="text" placeholder="Adresse e-mail" name="email">
							<input type="password" placeholder="Mot de passe" name="pass">
							<span>En cliquant sur "Valider", ci-dessous, vous acceptez les <a href="cgu.html">Conditions g&eacute;n&eacute;rales d'utilisation</a> de CUSTORIAL</span>
							<br>
							<input type="submit" value="Valider">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo __FACEBOOOK_APP_ID ?>', // Set YOUR APP ID
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
      
    });
    FB.Event.subscribe('auth.authResponseChange', function(response) 
    {
     if (response.status === 'connected') 
    {

    }    
    else if (response.status === 'not_authorized') 
    {

    } else 
    {

    }
    }); 
 
    };
 
    function Login()
    {
 
        FB.login(function(response) {
           if (response.authResponse) 
           {
           		
                Connect();
               
            } else 
            {
             console.log('User cancelled login or did not fully authorize.');
            }
         },{scope: 'email,user_interests,user_photos,user_videos,user_friends,user_birthday,user_likes,user_location'});
 
    }
  
  function Connect() {
  	data = new Array();
        FB.api('/me',{fields:'email,first_name,last_name,gender,birthday,location,id,likes, picture'}, function(response) {
          
          data.push({name: "s_login",value: response.email});
          data.push({name: "s_email",value: response.email});
          data.push({name: "s_firstname",value: response.first_name});
          data.push({name: "s_lastname",value: response.last_name});
          data.push({name: "s_genre",value: response.gender});
          birthday = CalculAge(response.birthday);
          data.push({name: "s_age",value: birthday});
          data.push({name: "s_city",value: response.location.name.split(',')[0]});
          data.push({name: "login",value: response.email});
          data.push({name: "action",value: "checkUserFB"});
          data.push({name: "s_pwd",value: response.id});
          data.push({name: "picture", value:response.picture.data.url});
          data.push({name: "b_facebook", value:'1'});
          var likes = new Array();
          for(att in response.likes.data)
          {
          	likes.push(response.likes.data[att].name);
          }

          data.push({name: "s_interest", value: likes.join(', ')});
          $.ajax({
				url: 'modules/login/action/actions.php', 
				type: 'POST', 
				data: data,
				success: function(data){
					if(data == 1){
						document.location.href = "home.php"
					}
				}
			});	
          
          
 		return false;
    });
   
    }
    function getPhoto()
    {
      FB.api('/me/picture?type=normal', function(response) {
 
          var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
          document.getElementById("status").innerHTML+=str;
 
    });

    }
    function CalculAge(birthday) {
    var td=new Date();
    
    var an=birthday.substr(6,4); // l'année (les quatre premiers caractères de la chaîne à partir de zéro)
    var age=td.getFullYear()-an; // l'âge du joueur
    return age
}
    function getBirthday()
	    {
	      FB.api('/me/games', function(response) {
	 
	           str= '';
	           
	       var info = response;    
          for(att in info)
          {
          	str+= '<b>- '+att+'</b> : '+info[att]+'<br/>';
          }
	          console.log(str);
	 
	    });
	    }
    function Logout()
    {
        FB.logout(function(){document.location.reload();});
    }
 
  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/fr_FR/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
 
</script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('.slider-img').first().addClass('active').siblings().css({left: -600 + "px"});
			setInterval(function(){
				var active = $('.slider-img.active');
				var next = typeof $(active).next()[0] == "undefined"? $('.slider-img').first():$(active).next();
				$(active).animate({left: 600 + "px"}, 600, function(){
					$(this).removeClass('active').css({left: -600 + "px"});
				});
				$(next).animate({left: 0 + "px"}, 600);
				$(next).addClass('active');
				
			}, 7000);
			
			$('form[name=login]').on('submit', function(){
			
			$.ajax({
				url: 'modules/login/action/actions.php', 
				type: 'POST', 
				data: {action: 'checkUser', login: $('[name=email]',this).val(), password: $('[name=pass]',this).val(), cookie: ( $('[name=keep-active]',this).is(':checked') ) ? '1' : '0'},
				success: function(data){
					if(data == 1){
						document.location.href = "home.php"
					}else{
						$('.error').css( 'visibility', 'visible' );
						setTimeout(function(){
							$('.error').css( 'visibility', 'hidden' );
						}, 5000);
					}
				}
			});
			return false;
		});
		
		$('form[name=register]').on('submit', function(){
			
			that = this;
			if($('[name=nom]',this).val() == "" || $('[name=email]',this).val()=="" || $('[name=pass]',this).val()=="" || $('[name=status]',this).val()==""){
				$('.error2').css( 'visibility', 'visible' );
				setTimeout(function(){
					$('.error').css( 'visibility', 'hidden' );
				}, 5000);
			}else{
				name= $('[name=nom]',this).val().split(" ");
				
				$.ajax({
					url: 'modules/frontuser/action/actions.php', 
					type: 'POST', 
					data: {action: 'insert', s_login: $('[name=email]',this).val(), s_pwd: $('[name=pass]',this).val(), s_email: $('[name=email]',this).val(),s_function:$('[name=status]',this).val(), s_firstname: $('[name=nom]',this).val().split(" ")[0], s_lastname: $('[name=nom]',this).val().split(" ")[1]},
					success: function(data){
						if(data == 1){
							$.ajax({
								url: 'modules/login/action/actions.php', 
								type: 'POST', 
								data: {action: 'checkUser', login: $('[name=email]',that).val(), password: $('[name=pass]',that).val()},
								success: function(data){
									if(data == 1){
										document.location.href = "home.php"
									}
								}
							});
						}else{
							$('.error2').css( 'visibility', 'visible' );
							setTimeout(function(){
								$('.error').css( 'visibility', 'hidden' );
							}, 5000);
						}
					}
				});
			}
			return false;
		});
			
		});
		
		// mot de passe oublié
		function ouverture(){
			$('.overlay, .mot_passe_oublie').fadeIn(function(){
				$("body").css("overflow", "hidden");
			});
		}
		
		function gestion_overlay(){
			if ( $(window).height() > $(window).width() ){
				$('.overlay').width( $(window).height()+100 );
			} else {
				$('.overlay').width( $(window).width()+100 );
			}
		}
		
		gestion_overlay();
		
		$('.overlay, #fermeture, #envoyerOubliMail').on("click", function(){
			$('.overlay, .mot_passe_oublie').fadeOut(function(){
				$("body").css("overflow", "auto");
			});
		});
		
		
		</script>
</body>
</html>