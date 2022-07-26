@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-dark text-center my-4">Contact us!</h2>
    <!--Section description-->
    <p class="text-center w-responsive text-dark mx-auto mb-5"> Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name2" name="firstname" class="form-control">
                            <label for="name" class="text-dark">Name</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email2" name="lastname" class="form-control">
                            <label for="email" class="text-dark">Surname</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="text-dark">Subject</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message" class="text-dark">Your message</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <button type="submit" class="btn btn-primary"
                        onclick="submitForm()">Submit</button>

            </div>

            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center text-dark">
            <ul class="list-unstyled mb-0">
                <li><i class="fa-solid fa-location-dot"></i>
                    <p>Mostar, BiH</p>
                </li>

                <li><i class="fa-solid fa-phone"></i>
                    <p>+387 -- --- ---</p>
                </li>

                <li><i class="fa-solid fa-envelope"></i>
                    <p>elizabeta.milicevic7@gmail.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
@endsection

<script>
    function submitForm(){
        var fname = document.getElementsByName("firstname")[0].value;
        var lname = document.getElementsByName("lastname")[0].value;
        var subject = document.getElementsByName("subject")[0].value;
        var message = document.getElementsByName("message")[0].value;
        window.open("mailto:elizabeta.milicevic7@gmail.com?subject="+subject+"&body="+message+"%0d%0a%0d%0a"+fname+"%20"+lname);
    }
</script>