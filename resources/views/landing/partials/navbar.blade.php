<style>


</style>
<!-- HEADER  -->
	<header class="main-header">
		<div class="container">
			<div class="logo">
                <a href="/"><img src="images/logo1.png" alt="logo" style="max-height: 90px; vertical-align: middle;"></a>
            </div>


			<div class="menu">
				<!-- desktop navbar -->
				<nav class="desktop-nav">
					<ul class="first-level">
						<li><a href="{{ url('/') }}" class="animsition-link">Home</a></li>
                        <li><a href="{{ url('/about') }}" class="animsition-link">about us</a></li>
                        <li><a href="{{ url('/service') }}" class="animsition-link">services</a></li>


						<li><a href="">operations</a>
							<ul class="second-level">
								<li><a href="{{ url('/operation_survey') }}" class="animsition-link">survey services</a></li>
								<li><a href="{{ url('/operation_rental') }}" class="animsition-link">rent</a></li>
								<li><a href="{{ url('/operation_lesson') }}" class="animsition-link">diving lessons</a></li>
							</ul>
						</li>

                        <li><a href="{{ url('/contact') }}" class="animsition-link">contact us</a></li>

                        <li><a href="{{ url('/sign-in') }}" class="animsition-link">Sign in</a></li>
					</ul>
				</nav>
				<!-- mobile navbar -->
				<nav class="mobile-nav"></nav>
				<div class="menu-icon">
					<div class="line"></div>
					<div class="line"></div>
					<div class="line"></div>
				</div>
			</div>
		</div>
	</header>


