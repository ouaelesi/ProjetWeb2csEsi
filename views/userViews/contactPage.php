<?php

class contactPage
{

    public function generalCOntacts()
    {
?>

        <div class="w-50 mx-auto mb-5 position-relative ">
            <img src="/ProjetWeb/public/images/contactBg.jpg" width="100%" height="100%" class="rounded-4 opacity-25 d-block mx-auto position-absolute bottom-0" />

            <div class="bluredBox  d-flex justify-content-between pt-5 px-4 position-relative">
                <div class="col-6 pb-4">
                    <div><img src="/ProjetWeb/public/logos/logo.png" width="60%" class="d-block mx-auto mb-3" /></div>
                    <div class="bluredBox d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                        <a href="tel:0560 68 65 72" class="  text-decoration-none text-light ">+213 7 95 95 15 19</a>
                    </div>
                    <div class="bluredBox d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                        <a href="tel:0560 68 65 72" class="  text-decoration-none text-light ">+213 7 95 95 15 19</a>
                    </div>
                    <div class="h5 d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                        <span>jo_sahbi@esi.dz</span>
                    </div>


                </div>
                <div class="col-6 position-relative h-100 px-5 pt-5">
                    <div class="artFont my-auto h1 text-center pt-3 text-warning">Nos Informations</div>
                    <div class=" my-auto  text-center ">some randome here to say about our informations</div>
                </div>
            </div>
        </div>
    <?php
    }

    public function contactForm()
    {
    ?>

        <div class="w-50 mx-auto mb-5  mt-5 py-5 ">

            <div class="bluredBox  d-flex justify-content-between pt-5 px-2 position-relative">
                <div class="col-6 position-relative h-100 px-4 ">
                    <div class="artFont my-auto h1   text-warning">Contact Form</div>
                    <div class=" my-auto   ">Laissez votre numéro, nos experts vous rappelerons</div>
                </div>
                <div class="col-6 pb-4 px-4">
                    <form action="/ProjetWeb/api/apiRoute.php" method="POST">
                        <input name="name" class="mb-2 bluredBox w-100 rounded-2 px-3 py-2" placeholder="Nom et prenom " />
                        <input name="email" class="mb-2 bluredBox w-100 rounded-2 px-3 py-2" placeholder="adress email" />
                        <input name="subject" class="mb-2 bluredBox w-100 rounded-2 px-3 py-2" placeholder="subject" />

                        <textarea name="body" class="mb-2 bluredBox w-100 rounded-2 px-3 py-2" placeholder="Body" rows="3"></textarea>
                        <button class="btn btn-yellow px-3 d-block ms-auto" name="sendEmail" type="submit">Send email</button>
                    </form>
                </div>

            </div>
        </div>
<?php
    }
    public function displaycontactPage()
    {
        $sharedComponents = new sharedViews();

        // NavBar 
        $sharedComponents->NavBar(null);
        // header 
        $sharedComponents->pageHeader('Contactez Nous', "contact.jpg");
        // navLinks 
        $sharedComponents->navLinks();
        // nos infos
        $this->generalCOntacts();
        // contact form
        $this->contactForm();
        // footer 
        $sharedComponents->Footer();
    }
}
