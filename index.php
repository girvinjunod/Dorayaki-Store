<?php
include "component/header.php";
?>
<?php
if (!isset($_SESSION["username"])){
    header('Location: '. "login.php");
  }

?>



 <!-- Start of Dashboard -->
<section class="dashboard">
    <div class="container">
        <div class="paragraph">
            <div class="title">
                <h1> 
                    LOREM 
                    <br> IPSUM DOLOR 
                </h1>
            </div>
            <div class="subtitle">
                <h4> lorem ipsum dolor sit amet </h4>
            </div>
            <div class="content">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Dolor saepe necessitatibus quam eligendi suscipit animi 
                assumenda vel laborum at nam natus quod, fuga beatae 
                aperiam ad molestiae consequatur soluta voluptas?
            </div>
            <a href="#"> <button class="primary-button"> Learn More </button> </a>
        </div>
        <div class="flat">
            <img src="assets/img/doraemon1.png">
        </div>
    </div>
    <div class="arrow-down">
        <a href="#item-list"> &#8964; </a>
    </div>
</section>
<!-- End of Dashboard -->


<!-- Start of Item List -->
 <section id="item-list">
    <div class="container">
        <div class="card-list">
            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

            <div class="card">
                <img src="https://dummyimage.com/600x600/000/fff">
                <div class="card-content">
                    <div class="title">
                        <h6> Dorayaki </h6>
                    </div>
                    <div class="subtitle">
                        <h6> Rp 5.000,00-</h6>
                    </div>
                    <div class="content">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    </div>
                    <button class="primary-button">
                        BUY
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End of Item List -->


<?php
include "component/footer.php";
?>

