<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 pr-lg-4">
				<h2 class="cms-footer-heading-class">Subscribe and stay updated!</h2>
				<p class="cms-footer-content-class">Suspendisse dictum mattis eros at vehicula</p>
				<form action="{{ route('satirtha.subscribe') }}" method="POST">
					@csrf
					<input type="text" name="mail_address" placeholder="Your Mail Address">
					<input type="submit" value="Subscribe">
				</form>
				<ul class="con">
					<li class="footer-email-address-class"><a href="#"><i class="fas fa-phone-alt"></i></a></li>
					<li class="footer-contact-number-class"><a href="#"><i class="fas fa-envelope"></i></a> </li>
				</ul>
			</div>
			<div class="col-lg col-md-4">
				<h3>Discover</h3>
				<ul class="mennu">
					<li><a href="{{ route('satirtha.choose-us') }}">Why Choose Us</a></li>
					<li><a href="{{ route('satirtha.cms-courses') }}">Courses</a></li>
					<li><a href="{{ route('satirtha.cms-blog') }}">Blogs</a></li>
				</ul>
			</div>
			<div class="col-lg col-md-4">
				<h3>Support</h3>
				<ul class="mennu">
					<li><a href="{{ route('satirtha.policy') }}">Privacy Policy</a></li>
					<li><a href="{{ route('satirtha.terms') }}">Terms & Conditions</a></li>
					<li><a href="{{ route('satirtha.contact') }}">Contact Us</a></li>
				</ul>
			</div>
			<div class="col-lg col-md-4">
				<ul class="social">
					<li class="footer-facebook-class"><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
					<li class="footer-instagram-class"><a href="#"><i class="fab fa-instagram"></i> instagram</a></li>
					<li class="footer-twitter-class"><a href="#"><i class="fab fa-twitter"></i> twitter</a></li>
					<li class="footer-youtube-class"><a href="#"><i class="fab fa-youtube"></i>youtube</a></li>
				</ul>
			</div>
			<div class="col-lg-12">
			<hr>
			</div>
			<div class="col-lg-6 col-md-6">
				<h6 class="footer-copyright-class"> </h6>
			</div>
			<div class="col-lg-6 col-md-6">
				<h5><a href="{{ route('satirtha.policy') }}">Privacy Policy </a> | <a href="{{ route('satirtha.legal') }}">Legal Notice </a> </h5>
			</div>
		</div>
	</div>
</footer>