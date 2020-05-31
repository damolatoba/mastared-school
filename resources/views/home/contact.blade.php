@extends('layouts.home')
@section('content')

<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-5 animate-box">
					
					<div class="fh5co-contact-info">
						<h3>Contact Information</h3>
						<ul>
							<li class="address"  style="word-wrap: break-word;">Plot 1 Block 1-3, Diamond Estate, LASU-Isheri Road, Isheri-Olofin, Lagos.</br>
							<b>Annex: </b>2/4, Olumuyiwa Olunowo Str., By Ile Ato B/Stop, Off Old Akesan Rd, Egan, Lagos.
							</li>
							<li class="phone">08039291970</li>
							<li class="phone">08022913254</li>
							<li class="phone">08135007643</li>
							<li class="email"><a href="mastaredschools@gmail.com">mastaredschools@gmail.com</a></li>
						</ul>
					</div>

				</div>
				<div class="col-md-7 animate-box">
					<h3>Get In Touch With Us</h3>
					<form action="#">
						<div class="row form-group">
							<div class="col-md-6">
								<!-- <label for="fname">First Name</label> -->
								<input type="text" id="fname" class="form-control" placeholder="Your firstname" require>
							</div>
							<div class="col-md-6">
								<!-- <label for="lname">Last Name</label> -->
								<input type="text" id="lname" class="form-control" placeholder="Your lastname" require>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-6">
								<!-- <label for="email">Email</label> -->
								<input type="text" id="email" class="form-control" placeholder="Your email address" require>
                            </div>
                            <div class="col-md-6">
								<!-- <label for="email">Email</label> -->
								<input type="text" id="mobile" class="form-control" placeholder="Your phone number" require>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="subject">Subject</label> -->
								<input type="text" id="subject" class="form-control" placeholder="Your subject of this message" require>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="message">Message</label> -->
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us" require></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Send Message" class="btn btn-primary">
						</div>

					</form>		
				</div>
			</div>
			
		</div>
	</div>
	<!-- <div id="map" class="fh5co-map"></div> -->
@endsection