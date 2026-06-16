<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClickUp - Librería</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: white;
            color: black;
        }

        :root {
            --primary-orange: #f97316;
            --dark-grey: #333;
            --light-grey: #e5e7eb;
        }

        /* --- Header / Navbar Identico --- */
        .header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            box-sizing: border-box;
            z-index: 10;
        }

        .logo-real {
            height: 90px;
            width: auto;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-grey);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .profile-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--dark-grey);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Blob / Vector Decorativo Superior Derecho */
        .banner-bg {
            position: absolute;
            top: 0;
            right: 0;
            width: 45vw;
            height: 55vh;
            background-image: url("{{ asset('images/Banner.jpg') }}");
            background-size: cover;
            background-position: -20% center;
            background-repeat: no-repeat;
            z-index: 1;
        }

        /* --- Contenedor Principal de Productos --- */
        .main-content {
            position: relative;
            z-index: 2;
            margin-top: 100px;
            padding: 20px 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .category-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin: 20px 0 50px 0;
            text-align: center;
            color: #000;
        }

        /* Panel Central de Productos */
        .products-panel {
            background-color: #dcdcdc; 
            border-radius: 40px;
            width: 100%;
            max-width: 1100px;
            padding: 40px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* --- Fila de Filtros y Carrito --- */
        .filter-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            width: 100%;
            margin-bottom: 40px;
            position: relative;
        }

        .filter-btn {
            border: none;
            padding: 10px 25px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 20px;
            cursor: pointer;
            color: white;
            background-color: #888888; 
        }

        .filter-btn.active {
            background-color: #ffaa00; 
        }

        .cart-icon-btn {
            background-color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: black;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* --- Grilla de Tarjetas Libros --- */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            width: 100%;
        }

        .product-card {
            background-color: white;
            border-radius: 25px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 20px; 
            box-sizing: border-box;
        }

        .product-image-container {
            width: 100%;
            height: 220px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }

        .product-image {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .product-info {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 0;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #000;
        }

        .product-description {
            font-size: 0.85rem;
            color: #555;
            margin: 0 0 15px 0;
            line-height: 1.4;
            min-height: 60px;
            height: 60px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .product-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: black;
            margin-bottom: 15px;
        }

        .btn-add-order {
            background-color: #ffaa00; 
            color: white;
            border: none;
            padding: 12px;
            font-size: 0.95rem;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s, transform 0.1s;
            text-align: center;
            margin-top: auto;
        }

        .btn-add-order:hover {
            background-color: #e59900;
        }
        
        .btn-add-order:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

    <div class="banner-bg"></div>

    <header class="header">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/LogoClickUp.png') }}" alt="Logo ClickUp" class="logo-real">
        </a>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Couriers Corporativos</a></li>
                <li><a href="#">Sobre Nosotros</a></li>
                <li><a href="#">Afilia tu Negocio</a></li>
                <li>
                    @if(session()->has('cliente_id'))
                        <div class="user-welcome-box" style="display: flex; align-items: center; gap: 10px;">
                            <span>Hola, <strong style="color: #000;">{{ session('cliente_nombre') }}</strong></span>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ef4444; text-decoration: none; font-size: 0.85rem; font-weight: bold;">Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="profile-link">
                            <span style="display: flex; align-items: center; gap: 5px;"><i class="fa-solid fa-user"></i> Mi Perfil</span>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <h1 class="category-title">Libros</h1>

        <div class="products-panel">
            
            <div class="filter-row">
                <button class="filter-btn active">Todos</button>
                <button class="filter-btn">Mangas</button>
                <button class="filter-btn">Novelas</button>
                <button class="filter-btn">Favoritos</button>
                
                <div style="display: flex; align-items: center; gap: 12px; margin-left: 15px;">
                    <span id="cart-total-text" style="font-weight: 700; font-size: 1.15rem; color: #222;">S/ 0.00</span>
                    <button class="cart-icon-btn" onclick="window.location.href='{{ route('carrito.detalles') }}'" aria-label="Carrito" style="position: relative;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span id="cart-count" style="position: absolute; top: -5px; right: -5px; background-color: var(--primary-orange); color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 0.75rem; display: flex; align-items: center; justify-content: center; font-weight: bold; display: none;">0</span>
                    </button>
                </div>
            </div>

            <div class="products-grid">
                
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://www.crisol.com.pe/media/catalog/product/9/7/9786287641587_wsmke01yeipokjgg.jpg?width=700&height=1050&store=default&image-type=image" alt="Cien años de soledad" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Novela'"> 
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Cien años de soledad</h2>
                        <p class="product-description">Es una saga que mezcla realismo mágico con la historia de Colombia, explorando la soledad, el destino cíclico, el amor frustrado y la decadencia.</p>
                        <div class="product-price">S/ 35.00</div>
                        <button class="btn-add-order" data-name="Cien años de soledad" data-price="35.00">Agregar al Pedido</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img src="data:image/webp;base64,UklGRrIcAABXRUJQVlA4IKYcAAAQbwCdASrBAAEBPk0ijkUioiETOgWwKATEshVCMJNeLRpNPQf+d88K6P3n8Q/vN/nfmR4S9r+Wjy1/m/75+z/+L///2P/0/6ue+j/Bf5f/qe4N/VP7b/gPzI/wH1p9HX7geoT+W/1b/hf4L3S/9h/x/9Z7jv2Y/03+V/zPyB/xz+ieqv/3PZs/rX+x9h7+af1/7//jN/8/+e+GH+vf6//u/634Ff5//eP+x+f+yr9RO2H+l/kH+43r34lfKXspu2WpT8b+un3v+3/t3+V33y/jv8J5J/Dr+c9QX8e/lP97/Kz8tOSsAB+jfzf+6/2v91f8H6aH9T/UPVX8u/rn+P9wD+T/zT/Hf2n9xP8J///mn/R+LJ9P/yn++/xX5AfYF/G/5p/mf7p/if+Z/mf/////rE/0/85+T/uY+h/+J/i/yE+w3+Wf1H/ef4j8pPnd9iH7U///3Wf2z//5aM2w3SRYxF6l3q1o6W6EuFms5astuJQaKtZNFGMrus86h9GA0Ty+YLHuxGRj2iCXlF2dk9dTKU+kzD7jqvINMdidLwmAOQL+//JZRx6//qI87UpyMoFqyLLZhl6F2Ra++9NMOc4ikYSVTDwELWDWhGwsoiN9/KTu6siyenfL6bz+3UH3Mi8WvNyVQHC9RMtxnqf8Y1RQ6mqsqjprbjQ8Zl4x+L7S0GA+pXJJUUtB9aT3wpUfnlhz09CkjXbphIn9RLffYVhMIC0WakTDxxX9lJtmNpP/3jyu8aJXcDxu817Va5+YnUirXX4l6Lf/DWlqSbku0RLcsJfzakuMe9r/74PvudEV/HWGS4hc4caql+6QYyhfdLjY3/xQHsbbUUiAUePnMS6mNVH6Z8oSWUAyHHkDflYjPgx4tXXj+9Spt+Vj7smKFo9y/UbJ7dGfuH9A0c57RUpnBYzHkKJdODBbXxOV2YmQrw0SK3gxGJiuw7scRthOW+zsGUztPMn3gj2mk0FgIoLhapSCRl97n09OrDa6XMm21SDW6HQMJS9fMg3Uogb32n1ZMtBlZSXgGNesgB+LMxdhNqdFQ//ssHzMwg0TuEcsBZUsD1idY8pUnlzX7nzdzsWBLgVdWE+XaMU9pAc0a2jX6zIW1q4/s+uGKZ7HOOvxyPVldQzmZ42iJZz03Y9dQCu0Sf+viPtmRA8qd+P7FpujfqfBO/oTc0UfKpCu99gUzAAA/v10nPJaS+T9c8SBoNMDrv+9iEJKsT/mjH97sWkGuxPrg95QMbxEUlDifPN7ssukmOvUOdypRItQJG2LMLph5XJ57FpBEmq/wAepyiDLoqb+c+X6uo6K0StqO/sjfwycAWBK6vI77tDGKHvsf5QXM6l8qPRqkcB33vCafhtjNu7lBixn4pb8eSJIiji5bRAXs6RB9JEyA2mHtIaBFfqJ9rHRM0aXe1gHDEgqPgwSpeF2tVD2Ye8cI+og32gqhwb6oyy7wHObCX4esKP+jWHLl7QsWcbdvEXlQjojwwBbA4hn3Q3+DmyHv2XUNwdk6eDOO8Sld0SDGvC3kL9aXlmevUzoksvDgTw4+VuHZQYsh+OWbR28RSH8pXJM6TQg4xU5jok02/6l9fwTJ4Jhz9Lqxof1EGmxICC8N2Uqske7VRA97LrhxRH7rCe4mehzOfidkoQAPTkJCrtiELcFfr5b9gZVkg1U3DbAxJS8bRq3/NDiFHwrqfES2q4/pE9g6jUCXlw8r++tSwwqP35diY0UMUmpH/t9/6PTTDhIm0QILDUn1Od5/8u8GMRMclSas30+uq9yMLCZh8wCJBWWhWfBSqUNRs/kQ8N26VLuaH9nYrH8zgNH1JhyIJoP2WPsDrz9cEsQqB6VSainydPIcY4FxhmFz+Eds71U16hNAUvd2fzKxXAhVIdYX9i+WSsa4r0PuKVI5XVecMN+0n1s9uxzAiwP6zH+YxvuHETBFJ0OVdnBWNLfz4AFJmZvhkQHi0M6OFtQ3/CLVkGbQP2jTm6FGhhI2sksveg7iveWxfDGfZc756nlrbgYnmOU6vBDjUBTuo++kIGicl0x85XRKu18Urn2wQuIITsyUNYYfK/pvr4j7nkI/cepki7X9UwIOOG1fw37eWQdw0uWPUnJkg2leTGAab/wVBXvC7gT/5TV6X+Q6x4Yafu6q2bSE+b9Q4Mr0/+wJ/fqxjHm7Kv1qfgRGPy5UPM1jk1KALDj8wnAhB/hyGbbZa9jOmmR43gAVwToCO1s+0IAdsdOYAdq2BN61/DONy9RcVKavuR5RKqyQhfVIpXK6RbgE96VUwT/43o7EGMznl4HKLAm/ugLiXaSGpCXPKzdxzwO7sPJ3CLaKcH5mw/CZZbb3+cMlGl0CGTY5NuzQEHADscPhwTdeH4xHgxSIYEn0k91nkDKD6wQP5g8DTCLqglw/C/LMic56qdMLrHenho5vEFRkhjDdcjfJn9xVxOw9qmk7EGJEa6llaiOe3Sgg/ZSSiZ4NJcbMTymKWoUpSryxFTNb72XagMQAEJ8+nzP/v2qEyT36U6zJcLw5cvRTj2bDnUhAQaycWLql7+VMMAKkv2M7IjoFS2x1D4ap34pd6mr7F3U8UHpsDzl2r+4WnOuSUEKf1K7uqJxmE3b05KVf5MmMuWYu3Kn0wm5ywQXJ4KnxoVSUVOxuNdI0DeHnwgb2gKEqNV3GwvvhvdeXcUnmvUOkMcuV0N3xJND0pDqDC4O3V+QPucMP/FrZ7PQB47d3QReHHZB1/PRkeZObajCm6I7PQqxQEuLAjSmdNaewxhV2XJnfg+MpyTi6HlaK11JGNO7TVkszr13kKGxivtBcnRfbrZAuJBfwsoOPFswYmZdB4mzDle6PX99ZkxdibWRbnXhZEUhRTJixIen6TYEiPMToErVai1Y5C51lImEbzoWqCewDDoyN2ZIckYfcv7k+RqOI7/DcE+mclVVn0V5QCnEvtCG9fHjTelxIAx2iCjii+22pgUHg5wemdas9nqLfFT0uL3oSOFC5taIQVdB+L8c4NMQlcVqoizi8ZBywrbE3Fkp+JJEXOlfWPjZuwqMpRCvsbXWWTnPYfG18MTBHevDe0H8EENEn1PSnsmoGVMDMaiAo1xsotIz+JCyaNjO7Ix4aiARSB7O804gIqXLzBy5zhutN2Elj5Oa+5iZ07FsiyjrcgF1aUaZISSaYqE6fgopdewzfufHLYuzcoaHzp1jjBAwBBq6R2p6Jbt16rknCsNzx8ZHRx6rk8p/X2IS6lqXYVGhI1/b9SCYrcuz9qXnbqkpLnncoJQgAZLDSczjCqN0suFbMV0f5iGJ4VfmavzSIUaNHBgB6WJDSagHBSac7fyuqey+5HAajuZZ0UJoxKlterOOlo0iTIy1CuEw/zlXRr6KNWbgGXuC3coK31ynVxR0b/whs85MNKhUlaSbJ7aVfw7MBxnbI/oDK3KtczyKkVyx/Wq+cJpkH4rqAkLLkhznbMeDgKg6/U5jq6krKT/zgQuF5YcMN/c2S9iNtYwCqIGksp3Q2f0FJEG8G8MyxA/BMAFB0D566AQHIQqoc5ev8mukW9teb7rMX3wDDU1pfty7t776LOAaVcGvXI45bo+0hVLCZt5ytX/OoYjdn0AsKOP7NQzRXihjqWVvBv6T2ltVPPK0EyVjrkB9cHY/q7g4My5/6/CTRCg4BN6XkKCAHPAAOkSon9ir3ncczo2KPuaTX7WL7b/YRqi3Mu8lbfL6f6SSBE5o2cfZU4XVDJmsDn7isRxZ693olUGWZde7V+xKeBpvopQSVV+RtENIpkcU8ipjb40MRdRPJJ8T3kac4oW84I9SyjSIZ+FxqS0djwoUyHi/IjLSNg4urGEjfDZYzAzEFGbVoxGlvVBJNuBL12ADkA5wiv6/Eq1xrpKmNPdCsGTiTK6unWluoYfOPo4Fx8qQEKYAmQLgkzF/JL/y4bK3hQrf8G0E2MBa/GCO/1E0GbxiMb8zYqWSTeCoQevArBcU95mZte4BFShwA9NAJNb4WObPaODz2oMJOQyLfAtTHpvj1vjWaGMXq4m3P88AJ6QihaEviInaq0e7sNoAcaCC9BlSX7brwYXeAvrAj7i6yogZd9uA8W0AzclkdeAqYI1BELKhHSOvKuV4cGjz+ljzUOxu5JKn3fpYwhTRWuU3lLazGCSHZGN6AVBhFYCkbZPMNt2RkZwGHN1/X0Ezo6B0WOeQ2l3cwPK1CBvT5f7NeDKsHpTqiLeBgqab1bQn+Wr/obGmTthWHjOMY3Brw0n2E5J1YFYNMMk4mZBKa/eacv+6hdjgcvPxkTqM3klkONeSBVvBEvVsK/eETN3nPcSYCzBe46+ozmS3rgFVN9isp4vzLE+93kST9Ycib7DSUj45jwr44jcfYWmBND/L5qeUD8Vic/exGYZWoB2+o515jnTHBLjuNUH5xIHqAEIJZew8R3s3L849mt7EckQfh0uOKCgVTV6/Y7b/pcnOazeT1+AGJinRYuFIe1N5SevNfDOTWIYV639NlqoQmwG1MeXk/isCrRC+2vih0rYHCuQw10n2Z4lPnjsQKgtRdiBix75oAqKm9A+DE71M7SJtSZTOkmPgbtSB+Gx2xf5RhvZqKFOGQXM5f2hIwsG4bK8OxaB6p0BMBiC0yPvlwi5YqX7w6XTb/QMUHWrZNsp3qNyFKjYb/Cs+tUieXak4vC6Ga7c43sAymmIbcQKcK8TuzbL90H7yJin185sVQ7yZu//39sF8SwUFsC25z5n0uwqutZGtrgnGamVqNTvP300PNIft0jXDjJ1wedfyYtdS0L1ghKfoFlaLsUWaE2o0kQPsQExhmVi0P/pKNMM6ORNcJlZktmquLCvdYP9q3BE25++HQPGAkWcaj5diT4pS1XfZeEscUjTOLLvhLwDY2dHqz71PBGAhnnAPtzwW+eKh7bwqb7hhbTEXSRhwuZiqJf5ZolG2HQkFFdixL2wGzWXDSGqNufRY+jwtKdkxTwCynA+j3UWZAlobgS/w7WtNSj31pMxCEfIuQoI4jxNKqa3f40htctROSNYeDBGABFq+gd3CN3q74+LzstnITQHrle5W4yCFNsRC91DTjtPxCooCQawXYPKeOag0strgvRNHS5ZXS/bmZVpMAwepjOKwdjCBzfh+vkJVNQnQhNKWP5yxy8Eq2OlWR39l6BcPHltWXZ/cKfDdOHnNmRCPuQM1b2Ns+uddaWktr9MfALLpQF4uYLwHx2IEyPeTmUGyH9/+fhEb67ZgCb9bqdLM4w62efXJ8ivVyGjbCDUdMpn5CIzQpHKzGp32VVgsMXQK/O85dyrHe8XYvovE1WWW+5mppatgvrtIvE/4m7Eg/gp/0XvbsR34xXvw3Q1V14zTvGGxmMNRuPc78xxVhYKzLE1lhfWtmpSe3+oPRSqKhtumMcqCGONZCDT7s3+9ZdCEhHZ5ZSvT//APzbFRVylh17UJIgot7Ge/FpWnY7d6yZKD7SD14ermnK0OxbhoCQT2lSL9n0GslUH1G5Hz8LbCwyOmzkNz/FtJNgil0yM3xF70t1GUjemhpNse/p8A2LNUn+AIbQsyQus+GwR5GZOje136MddaJNaW2h7Pbm+TxObOSTj/Os2a0RpKTC2jNk9Lh6rY243stUv3MRDqukIPIwpBE0RiALi+lfISz26neW8KcEMqV6SifhdbMxMOkG309dqYnOQ7trsGvLL/i/mgyg3GezgmdegqbEJCdFc3wqV3nneAOJsPuGCy2HdiVUNHbMA2juiNPbI3gzZeT+qwS9g7E/y8p3ybp7DuvQkmgnr5J19wndjnOANc+1VsHXlZXoHLbAcbc5vpRjuhDsnE2ofovNwaBJ1CtpW+4D0kbSS6QMQ211f4/BKu7HEdhywhpDZ5a0m4Eez+47WsgTO6OzmGuTFeJLGskBtvSBqGnsFJF8yzC9vXO+klgxIocspUwkZ0DMBrli5vYarWimfonbER+a7E46IghJSOP/4ZLu6uIHSSuXIl9G0i60lVTct/AzbjUigltySkLTSp0nWgbsrmSwGdqzjNpPuD10DSqylOzwfT90vaLnHIJivTbSTl8LeIy1f6LSnw3+eq2TbUFaPz5/9ngEqdrWqMGA2tgmYjGgI7O5ZAy79IoP8mEBtzddbpxfmTfI8Qe5VWUbszg74vKCoRFYC8xMX8nAibogA445B2DYV0yJnDTnhozNXwxb3E6XLIKya6H/lDAarEh94Te/eng7ju2wIVmFIOjIZA5Sq0TsfNk2lGWEwaAhafGIij6EVXEeVHVpzbcT5p4iJxSzxyYeccfshAnAPmpAz3zLn5M/KkTVRngeoiXg8+FXI8f6qI787AuHea0Sr1yXc4rW4zYpwe4H2z8obFUcthzUQ4lMO1q2XG1b/Pnlz+aAdwQGf66O9HuTc/IZYLJ8ZmRsLqo/lJSOqkLLmsE98U4HefBtAToCtjdlpIC9UO59Fsaaapf9hm79UOAuKg0OqztTQ60QYwotlU/dZeHG5D4n3N+MSPyBbmnMTMCHospMnzyJZ9n9UewYIFPItrywZrCFCirPF0aBQovLUP9vuiT3nA56A7hCz+02Bhpzn6Qz+PrqehTnT/l1F+UfrQDkIi2zLyKGnjuoT+ZYTjXHuskIMD4M038AWwljnyvWRcg2UGrOcAS3J4VqBA+HPoNSnR7/zi1reg/SzVi4YexUcwM6mXAwkmgEE2SNl9tuLpKlwPMbdqQu6YIYqUd/DaSie8Cd5zSkBLEsm+p+LDg8s0QqY9JJW+l6OhJki61/12vN0DTKM45Dax/vT2l1q3Xqqm8EDloyc2KtNbZd9WA++0dahR7J0aS/XDjpiPgFlqA2+i6JKCSe/q/19pMVBqYpX/JkE/1EZ56ClZwzlTzGSCTQ/uu9ybN+UeqcWyIx0w22v9M/Zzs9c2H5fkiaEAoPX/++JFqc/1jCLZ8d7w8YzMHBJxyO5kpphPVSmPm21gFqs48UUejxBKibblndKab1zRj9VsR9IiV/+rzNiGEFGG59w9+50PgD79PzzmieT9fz9gDGOQosCS0CD+tWQhYllMFZbdnPxgYXezM8pfp643NQUWZHsvGl+qkzlc+UkMs2lBKrWTIQNzkIcgO57eN6iXMr2db9qNc+Jr0+2GvQ49yN2z2GajLXQCpL0mXXK4c26lpgfUBCSixHxtn5SeUV7Q3dpMvHg442HhYI6QlkkFS1cKfzG+pVWSDPbs3WxWFY8gCo1NtNptWRtk5dkvzaDvgkCyaYMMWCVtJqttL6q86aUseFs24auRcNlhijXmaTmdkRuWPOkoHlnrWxiTfR0Hox9U0cX3dZYDl7PWnQ7agsR/ki/WBHPAQHFuF31MgynDHlDYhvkpe3Ms17hC+sTO9kImbYfJ63cB6/K2NgryDFX132rESJPnP4WTdJw4SUY1Ag28e8CkfjikzN1ecUpYDs2sbDMTIfPKdvpCus3L8aiUY0s2V+yMlt6PxAyzbm6Ss+GK4VVVY3mui7/FOoV8ptGMW8OTrUaJCA+cSP+c+GspoKYfp2SpeC/+ic9QgCswFjVbw19n5Kyz0JfJEa3+0FUDMcYkV3G+Aewp1jTtm2rPhfpFjCz+HWmIxSarkYfns8gTRiCeyHg8VLTVcxSjzVgz37NCVPtCjyag086MHSun5HXIplDw5ZYg57KKuIvWzPu3yKkk3f3DKxJRwG69pe3fhlcZNBvJo4Y+BKOHB2v5VO1TnE76vzaRCG10lSxz/o3BL0TUOsj4smRIoB1xjHl7dTUReHeIm8m/I68W20Z4AtUEDkYqjoJ7d+o7UjKrYeDNW9pbvJNaVfaw6U+s+JTk+Kc6CkcZSfGfi3r45gY4vi2TcFCCUgTrdGqZyTbyGEhMRhP1E7J5Cz2FmWBrBrK3cr23ZzthRsaTMLMvq00YkGojQadkkTIrx/Nq/tnEBZ17pw8dQ8cu/gM+qZesqvi1ruDLB6J7PlNI4BBmV1P0pcMH1NloD9lYNmgllIQmrdrC0fLUCU/wR/sXK62oGDE9+uEOu8DzIjEoFxhviGupVBf8yLQJatUaHGo2EAqUZ448x9/RzwAkDI+hr6J4JN75ZkhDPwu6+is4QEBDnY4tnQ0rp4VDdnh5rwQy2zT3yKTMsH+qReqTiNKBYKu6x2dOCO7MaDKrEoF4p4jQ0g7RIk1Xf0Db5KMJ/StLBtPoy4uDv/G7reHchXa7+/UqN3LQIoT/VMx4n1mKQIpSnCzsitLwgvZkplMmIs2pTp3x+mCxv3SS2EOsP+FTmmCx2HrAIQrQMffb6K7M9/TPEf/q/A4yxgyjqcBOV6hc7PY2kK6qo5e6q62/7692OTM6Tz7bitKT2rwpnVtSI3KzK2Aek2UakhB+ygXCm3x+vGRDsBIpRuJUiWMp+aBPiAEtVAvqDgavNIyMzs/lZ5KH+Oryrb2yLQeRo6TpseyzpfYOv3S71quwqfCd/ogiX/EJwpNgodzVp+B1xDp5LI4y0Qnn7ojMN0xiZrPiphJE1UgPskbE7fFovLSkM4+XXddiz/CXqZS0OuIO2o3Yl2s27VjgzciyNwfHuDYcsKO+h+ofFXupCxY0nLh0Y/P8nwhFbxqBUTxoFLsmU1EK1gpIqC7HD3aI77HjOuVzjjKj5Uc3kHNrc0Ov9ii+FlACjL7ZCjUGiyLFt1onB158RR4tJAnJO6zoO39F376/dy33n+afz3Ho4E/ZI0xZMN/PRCJ4bCX6JuXJZrBRLohKzsodl9Mr+AUlnyYfejfqxWTUJl/3fcz5TdLo0vkFoVWs+6U/rSWzlL9pnsnnDqvxX+PS8HPmcEKvPAJf1l54c9DmwE+BDP1WXwUgt5GD0I1JZyIlvTBhy0XseViTB/8VnvcZaa4VdkVhfDDJ4aqBvEPhdZ0XkJ6Y7cdOQDXyo2LAs0wPtLO4OlQstPic/3R7p35iEuueZbxtYZl2XHs5FwY8fbIX/yD/FEDqCobw2oydefeKA6mGuH4H32y3QAYr1HTIEnSmC+Mj+R8HJLqzpm4kgntt02/qL/5E21lqaU/Pm2VSRsI2ut/3laTyJtCaGyLNvDjeHNq9lnkNadSE/+iM11vHv7V8Hs8H75pERYtcYQLsR/LS0PbC4/s4eyPsi0vRgUWSawnyIlEDVEDhOS6hO5gSpmlyyCT/MlHBVfT94E06lZ8zzFj6Tur/oh1e79ufEX8e+z9s93usm7/jgRjTjuO53SQiHbAVIka/aHyt6N9G+fJ4rtwbmN6w/Vbr+AYbqov/CdBp+fvlAoLCWW56cuB3bw381jWIQAktiVj6xhuA1PCPLtwLrhy8bw5gglQ6wnuN0zOrI185oCh69vmdyS0iKRLvFtQLkdZSyePIUbHRwMvz9RebzVODWbLZA+TrMtPTzUWLvTRGp2LaHobjJmx5p/JHI/3D7MEWZvU/IJNrUyOzFgOJwnpSmKXJhcd/hFu1VzfQimpl1o2VQZlpg/9ySdBBluZ8H0v25PmUEPeI7umTSdLRuOUXhsEhkdCVoC9oREhs3dWdnfELH9PgOd+5myBHtrleeqz/VRU3fNPo2BJO27gviXFAYB4weUfk21Cy+53TZRhxKAR4hVxI2p1+6cnwsrmsONOw4t6DACa7sAEsT81aUBbv+duun8LhgY3Qg3KA61SeG5+vn/M+MHMumCyyX+P74itI1Asv+RD4ftChEivLOLPrOAIS6muXC9rrFxu0yiJ2J7As3io/uW8FvwQ4p87gkAB91WizZ1VGs0TZugqPnrVwfvNNvWahGA6xnDsnmXFn4OZcBkKgqTyOv6Q13wDyI0AAAA==" alt="La asistenta" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Thriller'">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">La asistenta</h2>
                        <p class="product-description">Se caracteriza por mantener los misterios de los personajes, un universo compartido y una trama central unificada a lo largo de los libros, a menudo con finales en suspenso.</p>
                        <div class="product-price">S/ 65.00</div>
                        <button class="btn-add-order" data-name="La asistenta" data-price="65.00">Agregar al Pedido</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcRR9l-vh2cJENIWizaq08rQkS_GYAijBEPG25lkIRseX-s4fKvj93i4Kd9B8YQa01qDowMKxlb2A5q6iF5kYlnqy_7kLAo6NdXr-3o" alt="El nombre del viento" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Fantasía'">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">El nombre del viento</h2>
                        <p class="product-description">Narra la vida de Kvothe, un legendario mago, músico y aventurero que, tras años desaparecido, relata su verdadera historia de superación, magia y pérdida.</p>
                        <div class="product-price">S/ 32.00</div>
                        <button class="btn-add-order" data-name="El nombre del viento" data-price="32.00">Agregar al Pedido</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img src="data:image/avif;base64,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" alt="Aquiles" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Ficción'">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Aquiles</h2>
                        <p class="product-description">Es una novela reimaginada de la Guerra de Troya narrada por Patroclo, enfocándose en su intensa relación amorosa y amistad con Aquiles.</p>
                        <div class="product-price">S/ 35.00</div>
                        <button class="btn-add-order" data-name="Aquiles" data-price="35.00">Agregar al Pedido</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img src="https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcSIbeJLL3VSH0eAMSGU6hm23ChL-JXhD3vkFk5Btads7uOFtooukdW4li5Tj7EwJZFEmnOAE0cZ6KYb2__7mzfkdGj_qWJ1yLCpAp-mmMIZWw0H2fMxK0ek" alt="Habitos atomicos" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Desarrollo'">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Habitos atomicos</h2>
                        <p class="product-description">Basados en el libro de James Clear, se enfocan en construir sistemas y mejorar la identidad en lugar de solo alcanzar metas y haciendo los cambios obvios.</p>
                        <div class="product-price">S/ 32.00</div>
                        <button class="btn-add-order" data-name="Habitos atomicos" data-price="32.00">Agregar al Pedido</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image-container">
                        <img src="data:image/webp;base64,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" alt="Harry Potter" class="product-image" onerror="this.src='https://placehold.co/200x300/e5e7eb/a3a3a3?text=📖+Magia'">
                    </div>
                    <div class="product-info">
                        <h2 class="product-name">Harry Potter - La Piedra Filosofal</h2>
                        <p class="product-description">Es la novela debut de J.K. Rowling que introduce a Harry Potter, un niño huérfano que descubre a sus 11 años que es un mago.</p>
                        <div class="product-price">S/ 70.00</div>
                        <button class="btn-add-order" data-name="Harry Potter - La Piedra Filosofal" data-price="70.00">Agregar al Pedido</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        let carrito = JSON.parse(localStorage.getItem('clickup_cart')) || [];
        actualizarInterfazCarrito();

        document.querySelectorAll('.btn-add-order').forEach(boton => {
            boton.addEventListener('click', function() {
                const nombre = this.getAttribute('data-name');
                const precio = parseFloat(this.getAttribute('data-price'));

                const productoExistente = carrito.find(item => item.nombre === nombre);

                if (productoExistente) {
                    productoExistente.cantidad += 1;
                } else {
                    carrito.push({
                        nombre: nombre,
                        precio: precio,
                        cantidad: 1
                    });
                }

                localStorage.setItem('clickup_cart', JSON.stringify(carrito));

                this.innerText = "¡Agregado! ✓";
                this.style.backgroundColor = "#22c55e"; 
                
                setTimeout(() => {
                    this.innerText = "Agregar al Pedido";
                    this.style.backgroundColor = "#ffaa00"; 
                }, 800);

                actualizarInterfazCarrito();
            });
        });

        function actualizarInterfazCarrito() {
            const contadorBurbuja = document.getElementById('cart-count');
            const textoTotal = document.getElementById('cart-total-text');

            let totalPrecio = 0;
            let totalProductos = 0;

            carrito.forEach(item => {
                totalPrecio += item.precio * item.cantidad;
                totalProductos += item.cantidad;
            });

            textoTotal.innerText = `S/ ${totalPrecio.toFixed(2)}`;

            if (totalProductos > 0) {
                contadorBurbuja.innerText = totalProductos;
                contadorBurbuja.style.display = 'flex';
            } else {
                contadorBurbuja.style.display = 'none';
            }
        }
    </script>
</body>
</html>