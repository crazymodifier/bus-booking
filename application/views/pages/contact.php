<main>
    <section>
        <img src="<?=base_url('dist/img/contact-banner-1 - Copy.jpg')?>" class="img-fluid" style="min-height:200px;object-fit:cover;object-position:left">
    </section>
    <div class="container-fluid p-lg-5 p-2">
        <div class="row">
            <div class="col-lg-6">
                <div class='card bg-warning'>
                    <div class="card-body p-lg-5">
                        <h3>Get in Touch!</h3>
                        <p>Just leave us your details and queries. We will get back to you with best possible solution as soon as possible...!</p>
                        <form action="<?=base_url('welcome/sendquery')?>" method="POST">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Name*" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Email*" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Subject*" required class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name='message' requierd placeholder="Message*"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger">Send Message <i class="fa fa-paper-plane ml-2"> </i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 my-auto">
                <h2>Contact Info</h2>
				<ul class="">
				    <li class="py-2"><a href="mailto:support@hop-on-hop-off-bus-tours.com">support@hop-on-hop-off-bus-tours.com</a></li>
				    <li class="py-2">Monday-Friday:  9:00am to 5:00pm</li>
				    <li class="py-2">Saturday: 9:00am to 3:00pm</li>
				    <li class="py-2">Sunday: Closed</li>		
				</ul>
            </div>
        </div>
    </div>
</main>