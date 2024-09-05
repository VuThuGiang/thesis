<?php
require("/laragon/www/dulich/connection.php");
require("/laragon/www/dulich/include/nav.php");
?>

<!----Into------>
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('/assets/img/profile/anhSAPA.jpg'); width: 100%; height: 500px; background-position: center bottom; background-size: cover;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb1-3 bread">Places to Travel</h1>
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
                            <a href="/pages/des_view.php?id=<?php echo $data['id']; ?>" class="btn btn1" style="color: orange ;">KHÁM PHÁ</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!---header Choose--------------------------->

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-block-start: 85px;">
                <div class="search-wrap-1 ftco-animate p-4">
                    <form action="#" class="search-property-1">
                        <div class="row">
                            <div class="col-lg align-items-end">
                                <div class="form-group">
                                    <label for="#">Destination</label>
                                    <div class="form-field" style="width: 200px;">

                                        <input type="text" class="form-control" placeholder="Search place">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg align-items-end">
                                <div class="form-group">
                                    <label for="#">Check-in date</label>
                                    <div class="form-field" style="width: 200px;">

                                        <input type="date" class="form-control checkin_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg align-items-end">
                                <div class="form-group">
                                    <label for="#">Check-out date</label>
                                    <div class="form-field" style="width: 200px;">

                                        <input type="date" class="form-control checkout_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg align-items-end">
                                <div class="form-group">
                                    <label for="#">Price Limit</label>
                                    <div class="form-field">
                                        <div class="select-wrap" style="width: 200px;">

                                            <select name="" id="" class="form-control">
                                                <option value="">$5,000</option>
                                                <option value="">$10,000</option>
                                                <option value="">$50,000</option>
                                                <option value="">$100,000</option>
                                                <option value="">$200,000</option>
                                                <option value="">$300,000</option>
                                                <option value="">$400,000</option>
                                                <option value="">$500,000</option>
                                                <option value="">$600,000</option>
                                                <option value="">$700,000</option>
                                                <option value="">$800,000</option>
                                                <option value="">$900,000</option>
                                                <option value="">$1,000,000</option>
                                                <option value="">$2,000,000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg align-self-end">
                                <div class="form-group">
                                    <div class="form-field" style="width: 100px;">
                                        <input type="submit" value="Search" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-----------tour ------------------------->
<section class="ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4 mt-5">Tour Destination</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
                    <a href="#" class="img" style="background-image: url(/assets/img/profile/anhDN.jpg);"></a>
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
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-------------feedback footer------------>

<?php require("/laragon/www/dulich/include/function/fback.php");
require("/laragon/www/dulich/include/footer.php"); ?>