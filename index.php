<body>
    <!-----Navbar-------------->
    <?php require("/laragon/www/dulich/include/nav.php"); ?>
    <?php
  
    echo "";
    ?>

    <!------image--------------->
    <div class="slider-wrapper ">
        <div class="slide1 bg-cover" style="height: 555px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center" style="margin-top: 90px;">
                        <h1 style="color: aliceblue; font-size: 70px;">ENJOY YOUR VACATION</h1>
                        <h4 style="color: aliceblue;">“Once a year go some place you've never been before”</h4>

                    </div>
                </div>
            </div>
            <!---searchhhhhhhhhhhh--------------------------->
            <?php require("/laragon/www/dulich/pages/search_index.php") ?>

        </div>
    </div>
    <!-----------About ussss----------->
    <!-----service--------->
    <section class="ftco-section services-section bg-light" style="margin-block-start: 70px;">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate">
                    <h2 class="mb-4">It's time to start your adventure</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                        is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                        live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics,
                        a large language ocean.
                        A small river named Duden flows by their place and supplies it with the necessary regelialia.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                            <div class="media block-6 services d-block">
                                <div class="icon"><span class="bi bi-person-arms-up"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Activities</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                            <div class="media block-6 services d-block">
                                <div class="icon"><span class="bi bi-geo-alt"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Travel Arrangements</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                            <div class="media block-6 services d-block">
                                <div class="icon"><span class="bi bi-person-badge"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Private Guide</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-self-stretch ftco-animate">
                            <div class="media block-6 services d-block">
                                <div class="icon"><span class="bi bi-map"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Location Manager</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!----abt usss--->
    <section class="ftco-counter img" id="section-counter">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 d-flex mt-3">
                    <img src="./assets/img/profile/anhHanoi.jpg" alt="">
                </div>
                <div class="col-md-6 pl-md-5 py-5">
                    <div class="row justify-content-start pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <h2 class="mb-4">Make Your Tour Memorable and Safe With Us</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
    </section>
    <!------------best des------------------------------>
    <div class="container text-center mt-5">
        <h2 class="mb-4">Popular Destinations</h2>
        <div class="row">
            <?php
            include("/laragon/www/dulich/connection.php");
            $sqlSelect = "SELECT * FROM `location`";
            $result = mysqli_query($con, $sqlSelect);
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <div class="col-md-3">
                    <div class="destination-card">
                        <img src="/admin/anh/<?php echo $data['image_url']; ?>" alt="" class="img-fluid destination-image">
                        <div class="overlay">
                            <div class="overlay-text">
                                <h3><?php echo $data["name"]; ?></h3>
                                <a href="/pages/des_view.php?id=<?php echo $data['id']; ?>" class="btn">KHÁM PHÁ</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-----------tour ------------------------->
    <section class="ftco-section ftco-no-pt">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Population Tour</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">8 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i></span> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">10 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i></span> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">7 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i></span> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">8 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i></span> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">10 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="#" class="img" style="background-image: url(./assets/img/profile/anhDN.jpg);"></a>
                        <div class="text p-4">
                            <span class="price">$300/person</span>
                            <span class="days">7 Days Tour</span>
                            <h3><a href="#">Bali, Indonesia</a></h3>
                            <p class="location"><i class="bi bi-geo"></i></span> Bali, Indonesia</p>
                            <ul>
                                <li><i class="fas fa-shower" style="color: #92af70;"></i>2</li>
                                <li><i class="fas fa-bed" style="color: #92af70;"></i></span>3</li>
                                <li><i class="fas fa-mountain" style="color: #92af70;"></i>Near Mountain</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function updateProvinceId() {
            var select = document.getElementById("provinceSelect");
            var input = document.getElementById("provinceId");
            input.value = select.options[select.selectedIndex].value;
        }
    </script>
   

</body>
 <!-------------feedback footer------------>
 <?php require("/laragon/www/dulich/include/function/fback.php");
    require("/laragon/www/dulich/include/footer.php"); ?>