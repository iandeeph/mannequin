<div class="row mt-30">
	<div class="container">
		<div class="col s12">
			<h4 class="center">
				Contact Mannequin
			</h4>
		</div>
		<form class="col s12" method="POST" action="./index.php?menu=thankyou">
			<div class="row">
				<div class="input-field col s12 m6 l6">
					<i class="material-icons prefix">account_circle</i>
					<input id="icon_prefix" type="text" class="validate" name="firstName" required>
					<label for="icon_prefix">First Name</label>
				</div>
				<div class="input-field col s12 m6 l6">
					<i class="material-icons prefix hide-on-med-and-up">account_circle</i>
					<input id="icon_prefix" type="text" class="validate" name="lastName">
					<label for="icon_prefix">Last Name</label>
				</div>
				<div class="input-field col s12 m6 l6">
					<i class="material-icons prefix">phone</i>
					<input id="icon_telephone" type="tel" class="validate" name="phone" pattern="^0[0-9]{10,12}|^\(?\+62[0-9]{10,12}" required>
					<label for="icon_telephone">Telephone</label>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix">email</i>
					<input id="email" type="email" class="validate" name="email">
					<label for="email" data-error="wrong email format" data-success="">Email</label required>
				</div>
				<div class="input-field col s12" style="margin-top:25px">
					<i class="material-icons prefix">mode_edit</i>
					<textarea id="icon_prefix2" class="materialize-textarea" name="message"></textarea required>
					<label for="icon_prefix2">Your Message</label>
				</div>
				<div class="input-field col m12 l12">
					<button style="margin-left:20px" class="right waves-effect waves-light btn-large amber hide-on-small-only" type="submit" name="submit"><i class="material-icons right">send</i>Send Message</button>
					<button class="right waves-effect waves-light btn-large amber hide-on-small-only" type="cancel" onclick="javasrcipt:window.location.href='./index.php?menu=contact'" name="cancel"><i class="material-icons right">cancel</i>Cancel</button>
				</div>
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn amber hide-on-med-and-up" type="cancel" onclick="javasrcipt:window.location.href='./index.php?menu=contact'" name="cancel"><i class="material-icons right">cancel</i>Cancel</button>
				</div>
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn amber hide-on-med-and-up" type="submit" name="submit"><i class="material-icons right">send</i>Send Message</button>
				</div>
			</div>
		</form>
  	</div>
</div>
<div class="row">
	<div class="container">
		<div class="col s12">
			<h4 class="left">
				Google Maps
			</h4>
		</div>
		<div class="col s12 media">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15866.273865492554!2d106.733823!3d-6.188456!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x67c67e84fcc34a3a!2sMannequin!5e0!3m2!1sen!2sid!4v1506073059426" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
</div>