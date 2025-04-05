<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Scribe</title>
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            padding: 1rem 0;
        }
        
        .login-btn-container {
            text-align: right;
        }
        
        .login-btn {
            display: inline-block;
            padding: 0.5rem 2rem;
            font-size: 1.1rem;
            font-weight: 500;
            color: #fff;
            background-color: #0d6efd;
            border-radius: 0.3rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .login-btn:hover {
            background-color: #0b5ed7;
            color: #fff;
        }
        
        .hero-section {
            background-color: #f8f9fa;
            padding: 5rem 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #212529;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 2rem;
            color: #495057;
        }
        
        .cta-btn {
            display: inline-block;
            padding: 0.8rem 2.5rem;
            font-size: 1.2rem;
            font-weight: 500;
            color: #fff;
            background-color: #0d6efd;
            border-radius: 0.3rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .cta-btn:hover {
            background-color: #0b5ed7;
            color: #fff;
        }
        
        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 4rem 0;
        }
        
        .about-section {
            padding: 4rem 0;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .about-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #212529;
            text-align: center;
        }
        
        .about-content {
            font-size: 1.1rem;
            color: #495057;
            margin-bottom: 2rem;
        }
        
        .footer {
            text-align: center;
            padding: 2rem 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Class Scribe</h1>
            <h2 class="hero-subtitle">Capture Every Academic Moment</h2>
            <p class="lead mb-4">Your ultimate classroom companion for notes, insights, and collaborative learning.</p>
            <a href="#" class="cta-btn">Get Started</a>
        </div>
    </section>
    
    <!-- Divider -->
    <div class="container">
        <div class="divider"></div>
    </div>
    
    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <h2 class="about-title">About Class Scribe</h2>
            <p class="about-content">
                Class Scribe is a revolutionary digital note-taking platform designed specifically for students and educators. It transforms how you capture, organize, and utilize class information.
            </p>
            <p class="about-content">
                With powerful organization tools, intelligent search, and seamless collaboration features, Class Scribe helps you stay on top of your academic work. No more scattered notes or missed information from lectures!
            </p>
            <p class="about-content">
                Whether you're attending in-person classes, virtual lectures, or studying independently, Class Scribe adapts to your learning style and helps you build a comprehensive knowledge base throughout your educational journey.
            </p>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 Class Scribe. All rights reserved.<br>
            Developed by Straw Hat Developers</p>
        </div>
    </footer>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // You can add more interactive functionality here as needed
        console.log('Class Scribe landing page loaded');
    </script>
</body>
</html>