<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title><!--bale parang rough script lang muna toh kasi im figuring sht out ahahhahah pupush ko parin pero sayang kasi-->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #FFF1E9;
        }

        .sidebar {
            width: 20%;
            background-color: #fdd7a9;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }

        .user-icon {
            padding: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .menu {
            list-style: none;
            padding: 0;
            width: 100%;
        }

        .menu li {
            width: 100%;
        }

        .menu a {
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            color: #333; 
            transition: all 0.3s ease; 
        }

        .menu a:hover,
        .menu a:focus {
            text-decoration-color: #f29244;
            border-radius: 25px;
            background-color: #FFF1E9;
            color: #f29244;
        }

        .main-content {
            margin-left: 20%;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FDD7A9;
            margin: 0;
            padding: 20px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard {
            padding: 20px;
        }

        .logo {
            height: 75px;
        }

        .header-icons a {
            margin-left: 15px;
            color: #333;
            text-decoration: none;
            font-size: 18px;
        }

        .dashboard h1 {
            color: #f29244;
        }

        .stats {
            display: flex;
            gap: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #f29244;
            border-radius: 8px;
            flex: 1;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #333;
            margin: 10px 0 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <img src="user-icon.png" alt="User Icon" class="user-icon">
            <span>User</span>
        </div>
        <ul class="menu">
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="product.php">Product</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Adoptions Records</a></li>
            <li><a href="#">Sign Out</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <img src="Components/petpalLogo.png" alt="PetPal Logo" class="logo">
            <div class="header-icons">
                <a href="#"><span>?</span></a>
                <a href="#"><span class="bell">🔔</span></a><!--placeholder lang tong emoji ah huhu papalitan natin yan-->
                <a href="#"><span class="mail">✉️</span></a>
            </div>
        </header>
        <section class="dashboard">
            <h1>Welcome Admin</h1>
            <div class="stats">
                <div class="card">
                    <p>Total Products</p>
                    <!--js shit na dadagdagan in the future hsaufbshjbnda-->
                </div>
                <div class="card">
                    <p>Scheduled Services</p>
                    <!--diko pa kasi sure gagawin sa js kasi wala pa yung ibang pages ashdbahshahahaha-->
                </div>
                <div class="card">
                    <p>Adoptions</p>
                    
                </div>
                <div class="card">
                    <p>Total Sales</p>
                    
                </div>
            </div>
        </section>
    </div>

    <script>/*GINAGAGO AKO NG JS YAWA*/
        document.addEventListener('DOMContentLoaded', () => {
            const menuLinks = document.querySelectorAll('.menu a');
            
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    menuLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                });
            });
        });
    </script>
    
</body>
</html>
