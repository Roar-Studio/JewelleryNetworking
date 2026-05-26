<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coming Soon</title>

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  html, body {
    width: 100%;
    height: 100%;
    overflow: hidden; 
  }

  body {
    font-family: 'Aboreto', cursive;
    background: linear-gradient(180deg, #fdfbf6 0%, #f3efe6 100%);
    color: #457f89;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between; 
    text-align: center;
    min-height: 100vh;
    min-height: 100dvh; 
    padding: 24px 20px;
  }

  body::before {
    content: "";
    position: fixed;
    top: 0;
    width: 100%;
    height: 200px;
    background: radial-gradient(circle at center, rgba(204,170,62,0.15), transparent);
    z-index: -1;
    pointer-events: none;
  }

  .logo-wrap {
    width: 100%;
    display: flex;
    justify-content: center;
  }

  .logo {
    width: clamp(160px, 40vw, 360px);
    filter: drop-shadow(0 0 8px rgba(204,170,62,0.4));
  }

  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
    margin-top: -20px;
  }

  .divider {
    width: clamp(40px, 10vw, 80px);
    height: 2px;
    background: #ccaa3e;
    margin: clamp(12px, 3vh, 20px) 0;
  }

  h1 {
    font-size: clamp(32px, 10vw, 70px);
    letter-spacing: clamp(4px, 1.5vw, 8px);
    background: linear-gradient(
      90deg,
      #ccaa3e 20%,
      #fff5cc 40%,
      #ccaa3e 60%
    );
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shine 4s linear infinite;
  }

  @keyframes shine {
    to { background-position: -200% center; }
  }

  p {
    font-size: clamp(11px, 3vw, 20px);
    letter-spacing: clamp(1px, 0.5vw, 2px);
    font-weight: bold;
    max-width: 700px;
    line-height: 1.6;
    margin-top: 4px;
  }

  .footer {
    width: 100%;
    display: flex;
    justify-content: center;
  }

  .socials {
    display: flex;
    gap: 20px; 
    align-items: center;
  }

  .socials a {
    color: #457f89;
    transition: color 0.3s, transform 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
  }

  .socials a i {
    font-size: 22px;
    display: block;
    line-height: 1;
  }

.socials a {
    text-decoration: none;
}

.socials a i {
    display: block;
    line-height: 1;
    vertical-align: middle;
}

.mobile-break {
  display: inline;
}

@media (max-width: 768px) {
  .logo-wrap {
    justify-content: center;
    align-items: center;
    margin-top: 10px;
  }
}

@media (max-width: 768px) {
  .logo {
    width: 220px;  
  }
}

@media (max-width: 768px) {
  body::before {
    height: 150px;  
    background: radial-gradient(
      circle at center,
      rgba(204,170,62,0.05), 
      transparent
    );
  }
}

@media (max-width: 768px) {
  .mobile-break {
    display: block;
  }
}

@media (max-width: 768px) {
    .socials a i {
        font-size: 20px; 
    }
}

  .socials a:hover {
    color: #ccaa3e;
    transform: translateY(-3px) scale(1.1);
  }
</style>
</head>

<body>

  <!-- LOGO -->
  <div class="logo-wrap">
    <img src="/designlogo.png" class="logo" alt="Logo">
  </div>

  <!-- CENTER -->
  <div class="container">
    <div class="divider"></div>
    <h1>COMING SOON</h1>
    <div class="divider"></div>
    <p>
  Stay tuned for something <span class="mobile-break">truly remarkable.</span>
</p>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="socials">
    <a href="https://www.instagram.com/jewellerynetworking/" target="_blank">
        <i class="fab fa-instagram-square"></i>
    </a>
    <a href="https://www.facebook.com/people/Jewellery-Networking/61554254949019/" target="_blank">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.youtube.com/@JewelleryNetworking" target="_blank">
        <i class="fab fa-youtube"></i>
    </a>
</div>
  </div>

</body>
</html>