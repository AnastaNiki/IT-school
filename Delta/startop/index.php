<?php
require_once "./config/Database.php";
$in_btn = "";
if(Auth::isLogged()) {
    $in_btn = true;
} else {
    $in_btn = false;
}
?>

<?php
//запрос на авторизацию
require_once "./config/Database.php";
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(Auth::checkPassword($email,$password)) {
        $key = Auth::getKey($email);
        setcookie('key', $key, time() + 604800, '/');
        header("Location: index.php");
        exit();
    }
    else {
        $wrong = "Неправильный email или пароль!";
        header("Location: index.php");
    }
}
?>

<?php
require_once "./config/Database.php";
require_once  "./API/Objects/User.php";
if (isset($_POST['sumbit_reg'])) {
    // запрос на регистрацию
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $db = new Database();
    $user = new User($db);
    $user->email = $email;
    $data = $user->checkEmail();
   // проверка отсутствия такого email в базе
    if ( $data === false) {
        Auth::Register($email,$pass);
        header("Location: index.php");
    } else {
      $err = 'Такой e-mail уже существует или поле не заполнено';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./images/longo.png" type="image/png">
    <title>СтартОп</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="header__inner">

            <a href="./index.php" class="logo">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="23.6132" cy="24.3966" r="23.5013" fill="white"/>
                    <path d="M27.516 32.3599C32.8271 29.1545 35.4953 24.7623 33.0145 15.1323C24.1745 12.5528 19.2895 15.1542 15.808 20.6518C13.6798 20.5631 11.531 21.0366 10.147 22.4205C10.0742 21.9835 10.147 21.6193 10.2563 21.2915C8.39889 21.1094 7.19703 21.4372 5.77665 21.8378C9.41861 11.0575 18.2686 10.0013 22.2749 10.5841C15.9014 12.2229 14.0804 14.4081 12.0773 16.9211C13.9347 16.0106 14.9544 16.1563 16.1563 16.1199C23.8773 8.69022 31.1613 12.0408 36.438 11.7089C36.8428 19.5433 37.7533 24.8242 31.999 31.9625C31.999 31.9625 31.9261 33.8563 31.2341 36.078C35.7502 32.8002 37.5712 25.8804 37.5712 25.8804C38.6638 34.5483 31.5983 40.8854 26.2446 42.3058C26.6817 40.6305 26.7909 39.5743 26.6817 37.7169C26.3539 37.8261 26.0261 37.9354 25.6255 37.8261C27.3736 36.3693 26.9366 34.4027 27.516 32.3599Z" fill="#CD114E"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8409 29.2934L18.8409 33.2996C19.5276 33.0116 20.1986 32.7366 20.8498 32.4677C22.233 31.8965 23.5267 31.3531 24.6907 30.7728C29.2851 28.4819 31.8594 25.6146 29.949 18.1853C23.1677 16.2097 19.7918 18.6963 17.3536 23.4357C16.7543 24.6008 16.2115 25.9021 15.6888 27.3067C15.4373 27.9826 15.1904 28.6825 14.944 29.4026L18.8409 29.2934ZM21.3904 29.3662C24.775 27.9524 28.7397 24.9512 27.6071 20.578C23.6397 19.415 20.0152 23.2237 18.8046 26.7805L21.4713 26.7137L21.3904 29.3662Z" fill="#EE672C"/>
                    <path d="M17.3536 23.4357C15.0638 23.5495 13.7526 23.8409 12.1501 26.9729C13.6434 26.6452 14.4446 26.8637 15.6888 27.3067C16.2115 25.9021 16.7543 24.6008 17.3536 23.4357Z" fill="#EE672C"/>
                    <path d="M21.1094 35.9322C22.6391 35.2039 24.6058 33.8199 24.6907 30.7728C23.5267 31.3531 22.233 31.8965 20.8498 32.4677C21.2554 33.6196 21.2056 34.3613 21.1484 35.2123C21.133 35.441 21.1171 35.6776 21.1094 35.9322Z" fill="#EE672C"/>
                    <path d="M17.6496 30.5057L17.6132 34.4755C14.736 34.2205 13.6798 36.2965 11.7131 36.4422C11.9316 34.5483 13.8983 33.4557 13.7526 30.615L17.6496 30.5057Z" fill="#EE672C"/>
                </svg>
                <svg width="134" height="30" viewBox="0 0 134 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.992 11.48C0.992 10.0933 1.23733 8.73867 1.728 7.416C2.24 6.072 2.976 4.856 3.936 3.768C4.896 2.65867 6.06933 1.784 7.456 1.144C8.84267 0.482665 10.4213 0.151999 12.192 0.151999C14.2827 0.151999 16.0853 0.610666 17.6 1.528C19.136 2.44533 20.2773 3.64 21.024 5.112L17.632 7.448C17.248 6.59467 16.7467 5.92267 16.128 5.432C15.5093 4.92 14.848 4.568 14.144 4.376C13.44 4.16267 12.7467 4.056 12.064 4.056C10.9547 4.056 9.984 4.28 9.152 4.728C8.34133 5.176 7.65867 5.76267 7.104 6.488C6.54933 7.21333 6.13333 8.024 5.856 8.92C5.6 9.816 5.472 10.712 5.472 11.608C5.472 12.6107 5.632 13.5813 5.952 14.52C6.272 15.4373 6.72 16.2587 7.296 16.984C7.89333 17.688 8.59733 18.2533 9.408 18.68C10.24 19.0853 11.1467 19.288 12.128 19.288C12.832 19.288 13.5467 19.1707 14.272 18.936C14.9973 18.7013 15.6693 18.328 16.288 17.816C16.9067 17.304 17.3867 16.6427 17.728 15.832L21.344 17.912C20.896 19.0427 20.16 20.0027 19.136 20.792C18.1333 21.5813 17.0027 22.1787 15.744 22.584C14.4853 22.9893 13.2373 23.192 12 23.192C10.3787 23.192 8.896 22.8613 7.552 22.2C6.208 21.5173 5.04533 20.6213 4.064 19.512C3.104 18.3813 2.34667 17.1227 1.792 15.736C1.25867 14.328 0.992 12.9093 0.992 11.48ZM27.7615 23V9.976H22.4495V6.232H37.3935V9.976H32.0495V23H27.7615ZM38.5813 18.04C38.5813 16.952 38.8799 16.0027 39.4773 15.192C40.0959 14.36 40.9493 13.72 42.0373 13.272C43.1253 12.824 44.3733 12.6 45.7812 12.6C46.4853 12.6 47.1999 12.6533 47.9253 12.76C48.6506 12.8667 49.2799 13.0373 49.8133 13.272V12.376C49.8133 11.3093 49.4933 10.488 48.8533 9.912C48.2346 9.336 47.3066 9.048 46.0693 9.048C45.1519 9.048 44.2773 9.208 43.4453 9.528C42.6133 9.848 41.7386 10.3173 40.8213 10.936L39.4453 8.12C40.5546 7.39467 41.6853 6.85067 42.8373 6.488C44.0106 6.12533 45.2373 5.944 46.5173 5.944C48.9066 5.944 50.7626 6.54133 52.0853 7.736C53.4293 8.93067 54.1013 10.6373 54.1013 12.856V18.2C54.1013 18.648 54.1759 18.968 54.3253 19.16C54.4959 19.352 54.7626 19.4693 55.1253 19.512V23C54.7413 23.064 54.3893 23.1173 54.0693 23.16C53.7706 23.2027 53.5146 23.224 53.3013 23.224C52.4479 23.224 51.7973 23.032 51.3493 22.648C50.9226 22.264 50.6559 21.7947 50.5493 21.24L50.4533 20.376C49.7279 21.3147 48.8213 22.04 47.7333 22.552C46.6453 23.064 45.5359 23.32 44.4053 23.32C43.2959 23.32 42.2933 23.096 41.3973 22.648C40.5226 22.1787 39.8293 21.5493 39.3173 20.76C38.8266 19.9493 38.5813 19.0427 38.5813 18.04ZM49.0133 18.904C49.2479 18.648 49.4399 18.392 49.5893 18.136C49.7386 17.88 49.8133 17.6453 49.8133 17.432V15.736C49.3013 15.5227 48.7466 15.3627 48.1493 15.256C47.5519 15.128 46.9866 15.064 46.4533 15.064C45.3439 15.064 44.4266 15.3093 43.7013 15.8C42.9973 16.2693 42.6453 16.8987 42.6453 17.688C42.6453 18.1147 42.7626 18.52 42.9973 18.904C43.2319 19.288 43.5733 19.5973 44.0213 19.832C44.4693 20.0667 45.0026 20.184 45.6213 20.184C46.2613 20.184 46.8906 20.0667 47.5093 19.832C48.1279 19.576 48.6293 19.2667 49.0133 18.904ZM68.1563 23.32C66.8549 23.32 65.7029 23.032 64.7003 22.456C63.7189 21.8587 62.9509 21.0587 62.3963 20.056V29.816H58.1083V6.232H61.8523V9.112C62.4923 8.13067 63.3029 7.36267 64.2843 6.808C65.2656 6.232 66.3856 5.944 67.6443 5.944C68.7749 5.944 69.8096 6.168 70.7483 6.616C71.7083 7.064 72.5403 7.69333 73.2443 8.504C73.9483 9.29333 74.4923 10.2107 74.8763 11.256C75.2816 12.28 75.4843 13.3893 75.4843 14.584C75.4843 16.2053 75.1643 17.6773 74.5243 19C73.9056 20.3227 73.0416 21.3787 71.9323 22.168C70.8443 22.936 69.5856 23.32 68.1563 23.32ZM66.7163 19.672C67.3776 19.672 67.9749 19.5333 68.5083 19.256C69.0416 18.9787 69.5003 18.6053 69.8843 18.136C70.2896 17.6453 70.5883 17.1013 70.7803 16.504C70.9936 15.8853 71.1003 15.2453 71.1003 14.584C71.1003 13.88 70.9829 13.2293 70.7483 12.632C70.5349 12.0347 70.2149 11.512 69.7883 11.064C69.3616 10.5947 68.8603 10.232 68.2843 9.976C67.7296 9.72 67.1216 9.592 66.4603 9.592C66.0549 9.592 65.6389 9.66667 65.2123 9.816C64.8069 9.944 64.4123 10.136 64.0283 10.392C63.6443 10.648 63.3029 10.9467 63.0043 11.288C62.7269 11.6293 62.5243 12.0027 62.3963 12.408V16.344C62.6523 16.9627 62.9936 17.528 63.4203 18.04C63.8683 18.552 64.3803 18.9573 64.9563 19.256C65.5323 19.5333 66.1189 19.672 66.7163 19.672ZM82.2615 23V9.976H76.9495V6.232H91.8935V9.976H86.5495V23H82.2615ZM104.408 23.16C102.744 23.16 101.229 22.84 99.8638 22.2C98.5198 21.56 97.3571 20.696 96.3758 19.608C95.4158 18.4987 94.6691 17.2613 94.1358 15.896C93.6024 14.5093 93.3358 13.0907 93.3358 11.64C93.3358 10.1253 93.6131 8.68533 94.1678 7.32C94.7438 5.93333 95.5224 4.70667 96.5038 3.64C97.5064 2.552 98.6798 1.69867 100.024 1.08C101.389 0.439999 102.882 0.119999 104.504 0.119999C106.146 0.119999 107.64 0.450666 108.984 1.112C110.349 1.77333 111.512 2.65867 112.472 3.768C113.432 4.87733 114.178 6.11467 114.712 7.48C115.245 8.84533 115.512 10.2533 115.512 11.704C115.512 13.1973 115.234 14.6373 114.68 16.024C114.125 17.3893 113.346 18.616 112.344 19.704C111.362 20.7707 110.189 21.6133 108.824 22.232C107.48 22.8507 106.008 23.16 104.408 23.16ZM97.8158 11.64C97.8158 12.6213 97.9651 13.5707 98.2638 14.488C98.5624 15.4053 98.9891 16.2267 99.5438 16.952C100.12 17.656 100.813 18.2213 101.624 18.648C102.456 19.0533 103.394 19.256 104.44 19.256C105.506 19.256 106.456 19.0427 107.288 18.616C108.12 18.168 108.813 17.5813 109.368 16.856C109.922 16.1093 110.338 15.288 110.616 14.392C110.914 13.4747 111.064 12.5573 111.064 11.64C111.064 10.6587 110.904 9.72 110.584 8.824C110.285 7.90667 109.848 7.096 109.272 6.392C108.717 5.66667 108.024 5.10133 107.192 4.696C106.381 4.26933 105.464 4.056 104.44 4.056C103.352 4.056 102.392 4.28 101.56 4.728C100.749 5.15467 100.066 5.73067 99.5118 6.456C98.9571 7.18133 98.5304 7.992 98.2318 8.888C97.9544 9.784 97.8158 10.7013 97.8158 11.64ZM118.327 23V6.232H133.367V23H129.079V9.976H122.615V23H118.327Z" fill="white"/>
                </svg>       
            </a>

            <nav class="menu">

                <div class="menu__btn">
                    <span></span>
                </div>

                <ul class="menu__list">
                    <li class="menu__list-item">
                        <a class="menu__list-link link-main" href="index.php">Главная</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="index_vitrina.php">Стартапы</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="create-choose.php">Чат</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="./my.php">Подержка</a>
                    </li>
                    <li class="menu__list-item">
                        <a class="menu__list-link" href="./my.php">О нас</a>
                    </li>
                </ul>

            </nav>

            <div class="user-nav">
                <?php
                if($in_btn) {
                    echo "<a class='user-nav__link' href='./config/logout.php'>Выйти</a>";
                } else {
                    echo "<a class='user-nav__link'  id='first' onclick='first()' >Войти</a>";
                }
                ?>
            </div>
        </div>
    </div>
</header>

<section  class="top">
    <div class="container top__cont">
        <div class="top__inner">

            <h1 class="top__title title">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam
            </h1>
            <p class="top__text">
                Lorem ipsum dolor sit amet
            </p>
            <div class="create-choose-btn">
                <a href="create-choose.php" class="top__btn">Начать</a>
            </div>
        </div>
        <div class="top__image">
          <img src="/images/main-page__canva.svg" height="550px" width="550px" alt="">
        </div>
    </div>
</section>
<div id="first_2" class="second_hide" onclick="first_2()">
    
</div>
<div id="reg" class="form" onclick="first_3()">
    <div class="menu-1">
        <ul class="menu">
            <li class="menu__list-item">
                <a onclick="reg()" class="menu__list-link roz link-main-roz" href="#">Регистрация</a>
            </li>
            <li class="menu__list-item">
                <a onclick="vhod()" class="menu__list-link roz link-main" href="#">Вход</a>
            </li>
        </ul>
    </div>
    <div></div> <form action="" method="post">
        <div class="input-group"> 
            <input id="login_input" type="text" name="email" placeholder="Email">
        </div>
        <div class="input-group">
            <input id="password" type="password" name="password" placeholder="Password">
            <a href="#" class="password-control" onclick="return show_hide_password(this)"></a>
        </div>
        <div class="pass">
            <input id="submit-btn" type="submit" value="Зарегистрироваться" name="sumbit_reg">
            <a href="#" onclick="vhod()" >Есть аккаунт? <b>Войти</b></a>
        </div> </form>
    </div>
<div id="vhod" class="form" onclick="first_3()">
    <div class="menu-1">
        <ul class="menu">
            <li class="menu__list-item">
                <a onclick="reg()" class="menu__list-link roz link-main" href="#">Регистрация</a>
            </li>
            <li class="menu__list-item">
                <a onclick="vhod()" class="menu__list-link roz link-main-roz" href="#">Вход</a>
            </li>
        </ul>
    </div>

    <div><form action="" method="post" >
        <div class="input-group">
            <input id="login_input" type="text" name="email" placeholder="Email">
        </div>
        <div class="input-group">
            <input id="password" type="password" name="password" placeholder="Password">
    
        </div>
        <div class="pass">
            <input id="submit-btn" type="submit" value="Войти" name="submit">
            <a href="#" onclick="reg()">Нет аккаунта? <b>Зарегистрироваться</b></a>
        </div></form>
    </div>
</div>
</body>
</html>
<script>

    function first() {
    
    document.getElementById("first_2").setAttribute("style", "display: block");
    document.getElementById("vhod").setAttribute("style", "display: none");
    document.getElementById("reg").setAttribute("style", "display: block");
    
    
    }
    
    function first_2() {
    
    document.getElementById("first_2").setAttribute("style", "display: none");
    document.getElementById("vhod").setAttribute("style", "display: none");
    document.getElementById("reg").setAttribute("style", "display: none");
    

    }
    function reg() {
        
        document.getElementById("vhod").setAttribute("style", "display: none");
        document.getElementById("reg").setAttribute("style", "display: block");
        
    }
    function vhod() {
        document.getElementById("reg").setAttribute("style", "display: none");
        document.getElementById("vhod").setAttribute("style", "display: block");
        
        
    }

    function show_hide_password(target){
    var input = document.getElementById('password');
	if (input.getAttribute('type') == 'password') {
		target.classList.add('view');
		input.setAttribute('type', 'text');
	} 
    else {
		target.classList.remove('view');
		input.setAttribute('type', 'password');
	}
	return false;
    }
 </script>

  </script>


    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            this.classList.toggle("bi-eye");
        });
    
    </script>
