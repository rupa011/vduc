@extends('landing.master')

@section('content')

	<!-- HERO SECTION  -->
	<div class="site-hero_2">
		<div class="page-title">
			<div class="big-title montserrat-text uppercase">Contact us</div>
			<div class="small-title montserrat-text uppercase">home / contact</div>
		</div>
	</div>


	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<form action="#" method="post">
							<div class="col-md-6">
								<div class="input_1" style="margin-bottom:30px">
									<input type="text" name="name">
									<span>your name</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input_1" style="margin-bottom:30px">
									<input type="text" name="email">
									<span>your email</span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input_1" style="margin-bottom:30px">
									<input type="text" name="object">
									<span>object</span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="textarea_1" style="margin-bottom:30px">
									<textarea name="message"></textarea>
									<span>message</span>
								</div>
							</div>
							<div class="col-md-12">
								<a href="#" class="btn green"><span>send</span></a>
							</div>
						</form>
					</div>

					<h4 class="montserrat-text uppercase" style="margin-top:100px">contact info</h4>
					<p>Lorem ipsum dolor sit amet, conse adipisicing elit. Libero incidunt quod ab mollitia quia dolorum conse.</p>

					<p>
						13D, Functional apartment, Unique colony, <br/>
						Agadir 86360 <br/>
						+212 124-566-780 <br/>
						+212 124-566-780<br/>
						<div><a href="mailto:email@website.com" class="link">email@website.com</a></div>
					</p>

					<ul class="social-icons" style="margin-top:30px;">
						<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
						<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
						<li><a href="#"><i class="icon ion-social-youtube"></i></a></li>
						<li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
						<li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
						<li><a href="#"><i class="icon ion-social-instagram"></i></a></li>
					</ul>
				</div><!-- end col -->

				<div class="col-md-6">
					<div id="map" style="width:100%"></div>
				</div>

			</div>
		</div>
	</section>


@endsection
