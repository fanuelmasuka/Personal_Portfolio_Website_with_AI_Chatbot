<?php
// Start session and include config
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fanuel Masuka | Software Developer & Data Analyst</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2E8B57;
            --dark-green: #1A5D3A;
            --light-green: #90EE90;
            --lighter-green: #E8F5E9;
            --accent-green: #4CAF50;
            --text-dark: #333333;
            --text-light: #555555;
            --white: #FFFFFF;
            --light-gray: #F5F5F5;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
        }
        
        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--dark-green);
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            width: 70px;
            height: 4px;
            background-color: var(--primary-green);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--primary-green);
            color: var(--white);
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn:hover {
            background-color: var(--dark-green);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }
        
        /* Header & Navigation */
        header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-green);
        }
        
        .logo span {
            color: var(--dark-green);
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--primary-green);
        }
        
        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-green);
        }
        
        /* Hero Section */
        .hero {
            padding-top: 150px;
            padding-bottom: 80px;
            background: linear-gradient(135deg, var(--lighter-green) 0%, #ffffff 100%);
        }
        
        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .hero-text {
            flex: 1;
            padding-right: 40px;
        }
        
        .hero-text h1 {
            font-size: 3.2rem;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        
        .hero-text p {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }
        
        .hero-image {
            flex: 1;
            text-align: center;
        }
        
        .hero-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 50%;
            border: 8px solid var(--primary-green);
            box-shadow: var(--shadow);
        }
        
        .highlight {
            color: var(--primary-green);
            font-weight: 700;
        }
        
        /* About Section */
        .about {
            background-color: var(--light-gray);
        }
        
        .about-content {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        
        .about-text {
            flex: 1;
        }
        
        .about-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        .about-text p {
            margin-bottom: 20px;
            color: var(--text-light);
        }
        
        .about-image {
            flex: 1;
            text-align: center;
        }
        
        .about-image img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        
        /* Skills Section */
        .skills-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .skill-category {
            background-color: var(--white);
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }
        
        .skill-category:hover {
            transform: translateY(-10px);
        }
        
        .skill-category h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .skill-category h3 i {
            color: var(--primary-green);
        }
        
        .skill-list {
            list-style: none;
        }
        
        .skill-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .skill-list li:last-child {
            border-bottom: none;
        }
        
        .skill-level {
            color: var(--primary-green);
            font-weight: 500;
        }
        
        /* Projects Section */
        .projects {
            background-color: var(--lighter-green);
        }
        
        .projects-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .project-card {
            background-color: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-10px);
        }
        
        .project-image {
            height: 200px;
            overflow: hidden;
        }
        
        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .project-card:hover .project-image img {
            transform: scale(1.1);
        }
        
        .project-info {
            padding: 20px;
        }
        
        .project-info h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        
        .project-info p {
            color: var(--text-light);
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .tag {
            background-color: var(--light-green);
            color: var(--dark-green);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        /* Contact Section */
        .contact-container {
            display: flex;
            gap: 50px;
        }
        
        .contact-info {
            flex: 1;
        }
        
        .contact-info h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        .contact-info p {
            color: var(--text-light);
            margin-bottom: 30px;
        }
        
        .contact-details {
            list-style: none;
        }
        
        .contact-details li {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .contact-details i {
            width: 50px;
            height: 50px;
            background-color: var(--primary-green);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .contact-form {
            flex: 1;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-green);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
            transition: border 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark-green);
            color: var(--white);
            padding: 40px 0 20px;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--primary-green);
            transform: translateY(-5px);
        }
        
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Message Status Styles */
        .message-status {
            padding: 12px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        
        .message-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Admin Panel Styles */
        .admin-container {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 20px;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--lighter-green);
        }
        
        .messages-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .messages-table th,
        .messages-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .messages-table th {
            background-color: var(--lighter-green);
            color: var(--dark-green);
            font-weight: 600;
        }
        
        .messages-table tr:hover {
            background-color: rgba(46, 139, 87, 0.05);
        }
        
        /* AI Chatbot Styles */
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            font-family: 'Roboto', sans-serif;
        }
        
        .chatbot-button {
            width: 60px;
            height: 60px;
            background-color: var(--primary-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: none;
        }
        
        .chatbot-button:hover {
            background-color: var(--dark-green);
            transform: scale(1.1);
        }
        
        .chatbot-button i {
            color: var(--white);
            font-size: 1.5rem;
        }
        
        .chatbot-button .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }
        
        .chatbot-window {
            position: absolute;
            bottom: 70px;
            right: 0;
            width: 350px;
            height: 500px;
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            display: none;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        
        .chatbot-window.active {
            display: flex;
        }
        
        .chatbot-header {
            background-color: var(--primary-green);
            color: var(--white);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chatbot-header h3 {
            font-size: 1.2rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .chatbot-header .close-btn {
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .chatbot-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: var(--lighter-green);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .message {
            max-width: 80%;
            padding: 12px 15px;
            border-radius: 18px;
            line-height: 1.4;
            word-wrap: break-word;
        }
        
        .user-message {
            align-self: flex-end;
            background-color: var(--primary-green);
            color: var(--white);
            border-bottom-right-radius: 5px;
        }
        
        .bot-message {
            align-self: flex-start;
            background-color: var(--white);
            color: var(--text-dark);
            border-bottom-left-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .bot-message.typing {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .typing-indicator {
            display: flex;
            gap: 3px;
        }
        
        .typing-indicator span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary-green);
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-indicator span:nth-child(1) { animation-delay: 0s; }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }
        
        .chatbot-input {
            display: flex;
            padding: 15px;
            background-color: var(--white);
            border-top: 1px solid #eee;
        }
        
        .chatbot-input input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.3s ease;
        }
        
        .chatbot-input input:focus {
            border-color: var(--primary-green);
        }
        
        .chatbot-input button {
            width: 45px;
            height: 45px;
            background-color: var(--primary-green);
            border: none;
            border-radius: 50%;
            margin-left: 10px;
            color: var(--white);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .chatbot-input button:hover {
            background-color: var(--dark-green);
        }
        
        .suggested-questions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--white);
            border-top: 1px solid #eee;
        }
        
        .suggested-question {
            background-color: var(--lighter-green);
            color: var(--dark-green);
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid var(--light-green);
        }
        
        .suggested-question:hover {
            background-color: var(--light-green);
        }
        
        .chatbot-options {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }
        
        .chatbot-option {
            background-color: rgba(46, 139, 87, 0.1);
            color: var(--primary-green);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(46, 139, 87, 0.2);
        }
        
        .chatbot-option:hover {
            background-color: rgba(46, 139, 87, 0.2);
        }
        
        .message-time {
            font-size: 0.7rem;
            opacity: 0.7;
            margin-top: 5px;
        }
        
        .user-message .message-time {
            text-align: right;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .bot-message .message-time {
            text-align: left;
            color: rgba(0, 0, 0, 0.6);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-content, .about-content, .contact-container {
                flex-direction: column;
            }
            
            .hero-text, .about-text, .contact-info {
                padding-right: 0;
                margin-bottom: 40px;
            }
            
            .hero-text h1 {
                font-size: 2.8rem;
            }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                flex-direction: column;
                background-color: var(--white);
                padding: 20px;
                box-shadow: var(--shadow);
                transition: left 0.3s ease;
            }
            
            .nav-links.active {
                left: 0;
            }
            
            .nav-links li {
                margin: 10px 0;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .hero-text h1 {
                font-size: 2.2rem;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 20px;
            }
            
            /* Responsive adjustments for chatbot */
            .chatbot-window {
                width: 300px;
                height: 450px;
                right: 0;
                bottom: 70px;
            }
            
            .chatbot-container {
                bottom: 10px;
                right: 10px;
            }
        }
        
        @media (max-width: 480px) {
            .chatbot-window {
                width: calc(100vw - 20px);
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">Fanuel<span>Masuka</span></a>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if(isset($_SESSION['admin_logged_in'])): ?>
                    <li><a href="admin.php">Admin</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                </ul>
                <div class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Fanuel Masuka</h1>
                    <h2><span class="highlight">Software Developer</span> | <span class="highlight">Data Analyst</span> | <span class="highlight">IT Educator</span></h2>
                    <p>I create innovative software solutions, derive insights from data, and empower others through IT education. With a passion for technology and a commitment to excellence, I transform complex problems into elegant solutions.</p>
                    <a href="#contact" class="btn">Get In Touch</a>
                    <a href="#projects" class="btn" style="background-color: transparent; color: var(--primary-green); border: 2px solid var(--primary-green); margin-left: 15px;">View Projects</a>
                </div>
                <div class="hero-image">
                    <img src="images/hero.jpg" alt="Fanuel Masuka">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="section-title">
                <h2>About Me</h2>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3>Hello! I'm Fanuel, a passionate technology professional</h3>
                    <p>With over 5 years of experience in the tech industry, I specialize in software development, data analysis, and IT education. My journey began with a degree in Information Systems and has evolved through various roles that allowed me to hone my skills across multiple domains.</p>
                    <p>As a <strong>Software Developer</strong>, I build robust, scalable applications using modern technologies. As a <strong>Data Analyst</strong>, I transform raw data into actionable insights that drive business decisions. As an <strong>IT Educator</strong>, I share my knowledge to empower the next generation of tech professionals.</p>
                    <p>My approach combines technical expertise with creative problem-solving, always aiming to deliver solutions that are not only functional but also intuitive and user-friendly.</p>
                    <a href="#contact" class="btn">Contact Me</a>
                </div>
                <div class="about-image">
                    <img src="images/aboutMe.jpg" alt="Fanuel Masuka working">
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills section">
        <div class="container">
            <div class="section-title">
                <h2>My Skills</h2>
            </div>
            <div class="skills-container">
                <div class="skill-category">
                    <h3><i class="fas fa-code"></i> Software Development</h3>
                    <ul class="skill-list">
                        <li>PHP & Laravel <span class="skill-level">Expert</span></li>
                        <li>JavaScript & React <span class="skill-level">Advanced</span></li>
                        <li>Python & Django <span class="skill-level">Advanced</span></li>
                        <li>Java & Spring Boot <span class="skill-level">Intermediate</span></li>
                        <li>Database Design (MySQL, MongoDB) <span class="skill-level">Expert</span></li>
                        <li>RESTful APIs <span class="skill-level">Advanced</span></li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3><i class="fas fa-chart-bar"></i> Data Analysis</h3>
                    <ul class="skill-list">
                        <li>Python (Pandas, NumPy) <span class="skill-level">Advanced</span></li>
                        <li>R Programming <span class="skill-level">Intermediate</span></li>
                        <li>SQL for Data Analysis <span class="skill-level">Expert</span></li>
                        <li>Data Visualization (Tableau, Power BI) <span class="skill-level">Advanced</span></li>
                        <li>Statistical Analysis <span class="skill-level">Advanced</span></li>
                        <li>Machine Learning Basics <span class="skill-level">Intermediate</span></li>
                    </ul>
                </div>
                <div class="skill-category">
                    <h3><i class="fas fa-chalkboard-teacher"></i> IT Education</h3>
                    <ul class="skill-list">
                        <li>Curriculum Development <span class="skill-level">Advanced</span></li>
                        <li>Technical Training & Workshops <span class="skill-level">Expert</span></li>
                        <li>E-Learning Platforms <span class="skill-level">Intermediate</span></li>
                        <li>Mentorship Programs <span class="skill-level">Advanced</span></li>
                        <li>Instructional Design <span class="skill-level">Intermediate</span></li>
                        <li>Learning Management Systems <span class="skill-level">Advanced</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects section">
        <div class="container">
            <div class="section-title">
                <h2>My Projects</h2>
            </div>
            <div class="projects-container" id="projects-container">
                <!-- Projects will be loaded dynamically via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container">
            <div class="section-title">
                <h2>Contact Me</h2>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Let's Work Together</h3>
                    <p>I'm always open to discussing new opportunities, whether it's a software development project, data analysis work, or IT education collaboration. Feel free to reach out!</p>
                    <ul class="contact-details">
                        <li>
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p>fanuelmasuka2@gmail.com</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Phone</h4>
                                <p>+263776232095 | +263718080542</p>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Location</h4>
                                <p>Harare, Zimbabwe</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="contact-form">
                    <div id="message-status" class="message-status"></div>
                    <form id="contactForm" action="send_message.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">Fanuel Masuka</div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/fanuelmasuka1966"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://github.com/fanuelmasuka"><i class="fab fa-github"></i></a>
                    <a href="https://x.com/FanuelMasuka"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.facebook.com/fanuel.masuka.33"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
            <div class="copyright">
                &copy; <?php echo date("Y"); ?> Fanuel Masuka. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- AI Chatbot -->
    <div class="chatbot-container">
        <button class="chatbot-button" id="chatbotToggle">
            <i class="fas fa-robot"></i>
            <div class="badge" id="notificationBadge" style="display: none;">1</div>
        </button>
        
        <div class="chatbot-window" id="chatbotWindow">
            <div class="chatbot-header">
                <h3><i class="fas fa-robot"></i> Fanuel's AI Assistant</h3>
                <button class="close-btn" id="closeChatbot">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="chatbot-messages" id="chatbotMessages">
                <!-- Messages will be inserted here -->
                <div class="message bot-message">
                    Hello! I'm Fanuel's AI Assistant. I can help you learn more about his skills, projects, and experience. How can I assist you today?
                    <div class="message-time"><?php echo date('g:i A'); ?></div>
                </div>
            </div>
            
            <div class="suggested-questions">
                <div class="suggested-question" data-question="What are Fanuel's skills?">Skills</div>
                <div class="suggested-question" data-question="Tell me about his projects">Projects</div>
                <div class="suggested-question" data-question="How can I contact Fanuel?">Contact</div>
                <div class="suggested-question" data-question="What is Fanuel's experience?">Experience</div>
            </div>
            
            <div class="chatbot-input">
                <input type="text" id="chatInput" placeholder="Type your message here...">
                <button id="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Mobile Menu Toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('.nav-links').classList.remove('active');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Projects Data
        const projects = [
            {
                id: 1,
                title: "E-Learning Platform",
                description: "A comprehensive online learning platform with course management, video lectures, quizzes, and progress tracking.",
                image: "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80",
                tags: ["PHP", "MySQL", "JavaScript", "Laravel"],
                category: "Software Development"
            },
            {
                id: 2,
                title: "Sales Data Analytics Dashboard",
                description: "Interactive dashboard for visualizing sales performance, customer demographics, and revenue trends.",
                image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80",
                tags: ["Python", "Tableau", "SQL", "Data Visualization"],
                category: "Data Analysis"
            },
            {
                id: 3,
                title: "IT Training Curriculum",
                description: "Developed a comprehensive 12-week curriculum for beginner to intermediate software development training.",
                image: "https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=871&q=80",
                tags: ["Curriculum Design", "E-Learning", "Instructional Design"],
                category: "IT Education"
            },
            {
                id: 4,
                title: "Inventory Management System",
                description: "Web-based system for tracking inventory, orders, and suppliers with automated reporting features.",
                image: "https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80",
                tags: ["PHP", "MySQL", "JavaScript", "Bootstrap"],
                category: "Software Development"
            },
            {
                id: 5,
                title: "Customer Churn Prediction Model",
                description: "Machine learning model to predict customer churn with 87% accuracy for a telecom company.",
                image: "https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80",
                tags: ["Python", "Machine Learning", "Pandas", "Scikit-learn"],
                category: "Data Analysis"
            },
            {
                id: 6,
                title: "Coding Bootcamp Platform",
                description: "Platform for delivering coding bootcamps with interactive coding exercises and mentor support.",
                image: "https://images.unsplash.com/photo-1535223289827-42f1e9919769?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80",
                tags: ["PHP", "Laravel", "MySQL", "Education"],
                category: "IT Education"
            }
        ];

        // Function to display projects
        function displayProjects() {
            const projectsContainer = document.getElementById('projects-container');
            projectsContainer.innerHTML = '';
            
            projects.forEach(project => {
                const projectCard = document.createElement('div');
                projectCard.className = 'project-card';
                
                projectCard.innerHTML = `
                    <div class="project-image">
                        <img src="${project.image}" alt="${project.title}">
                    </div>
                    <div class="project-info">
                        <h3>${project.title}</h3>
                        <p>${project.description}</p>
                        <div class="project-tags">
                            ${project.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
                        </div>
                        <div class="project-category">
                            <span style="color: var(--primary-green); font-weight: 500;">${project.category}</span>
                        </div>
                    </div>
                `;
                
                projectsContainer.appendChild(projectCard);
            });
        }

        // Initialize projects on page load
        document.addEventListener('DOMContentLoaded', displayProjects);

        // Contact Form Submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageStatus = document.getElementById('message-status');
            
            // Simple client-side validation
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();
            
            if(!name || !email || !subject || !message) {
                showMessage('Please fill in all fields.', 'error');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;
            
            // In a real application, this would be an AJAX call to the server
            // For this example, we'll simulate a successful submission
            setTimeout(() => {
                showMessage('Thank you for your message! I will get back to you soon.', 'success');
                this.reset();
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });

        // Function to show message status
        function showMessage(text, type) {
            const messageStatus = document.getElementById('message-status');
            messageStatus.textContent = text;
            messageStatus.className = `message-status message-${type}`;
            messageStatus.style.display = 'block';
            
            // Hide message after 5 seconds
            setTimeout(() => {
                messageStatus.style.display = 'none';
            }, 5000);
        }

        // Header background on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if(window.scrollY > 100) {
                header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.backgroundColor = 'var(--white)';
                header.style.backdropFilter = 'none';
            }
        });

        // AI Chatbot JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Chatbot elements
            const chatbotToggle = document.getElementById('chatbotToggle');
            const chatbotWindow = document.getElementById('chatbotWindow');
            const closeChatbot = document.getElementById('closeChatbot');
            const chatbotMessages = document.getElementById('chatbotMessages');
            const chatInput = document.getElementById('chatInput');
            const sendMessageBtn = document.getElementById('sendMessage');
            const suggestedQuestions = document.querySelectorAll('.suggested-question');
            const notificationBadge = document.getElementById('notificationBadge');
            
            // Chatbot state
            let isChatOpen = false;
            let unreadMessages = 0;
            
            // Toggle chatbot window
            chatbotToggle.addEventListener('click', function() {
                isChatOpen = !isChatOpen;
                chatbotWindow.classList.toggle('active', isChatOpen);
                
                if (isChatOpen) {
                    unreadMessages = 0;
                    notificationBadge.style.display = 'none';
                    chatInput.focus();
                }
            });
            
            // Close chatbot
            closeChatbot.addEventListener('click', function() {
                isChatOpen = false;
                chatbotWindow.classList.remove('active');
            });
            
            // Send message function
            function sendMessage() {
                const messageText = chatInput.value.trim();
                if (!messageText) return;
                
                // Add user message to chat
                addMessage(messageText, 'user');
                
                // Clear input
                chatInput.value = '';
                
                // Show typing indicator
                showTypingIndicator();
                
                // Process message and generate response
                setTimeout(() => {
                    removeTypingIndicator();
                    const response = generateResponse(messageText);
                    addMessage(response, 'bot');
                }, 1000 + Math.random() * 1000);
            }
            
            // Send message on button click
            sendMessageBtn.addEventListener('click', sendMessage);
            
            // Send message on Enter key
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
            
            // Suggested questions click handler
            suggestedQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const questionText = this.getAttribute('data-question');
                    chatInput.value = questionText;
                    sendMessage();
                });
            });
            
            // Add message to chat
            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}-message`;
                
                const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                messageDiv.innerHTML = `
                    ${text}
                    <div class="message-time">${time}</div>
                `;
                
                chatbotMessages.appendChild(messageDiv);
                
                // Scroll to bottom
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
                
                // Show notification badge if chat is closed
                if (sender === 'bot' && !isChatOpen) {
                    unreadMessages++;
                    notificationBadge.textContent = unreadMessages;
                    notificationBadge.style.display = 'flex';
                }
            }
            
            // Show typing indicator
            function showTypingIndicator() {
                const typingDiv = document.createElement('div');
                typingDiv.className = 'message bot-message typing';
                typingDiv.id = 'typingIndicator';
                typingDiv.innerHTML = `
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="message-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                `;
                
                chatbotMessages.appendChild(typingDiv);
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }
            
            // Remove typing indicator
            function removeTypingIndicator() {
                const typingIndicator = document.getElementById('typingIndicator');
                if (typingIndicator) {
                    typingIndicator.remove();
                }
            }
            
            // AI Response Generator
            function generateResponse(userMessage) {
                const message = userMessage.toLowerCase().trim();
                
                // Skills related questions
                if (message.includes('skill') || message.includes('what can you do') || message.includes('expert')) {
                    return `Fanuel has expertise in three main areas:
                    
                    1. **Software Development**: PHP/Laravel, JavaScript/React, Python/Django, Java/Spring Boot, Database Design, RESTful APIs
                    
                    2. **Data Analysis**: Python (Pandas, NumPy), R Programming, SQL, Data Visualization (Tableau, Power BI), Statistical Analysis
                    
                    3. **IT Education**: Curriculum Development, Technical Training, E-Learning Platforms, Mentorship Programs
                    
                    You can view detailed information in the Skills section of the portfolio.`;
                }
                
                // Projects related questions
                if (message.includes('project') || message.includes('work') || message.includes('portfolio')) {
                    const projectList = projects.map(p => `- ${p.title}: ${p.description.substring(0, 80)}...`).join('\n');
                    return `Fanuel has worked on several notable projects including:
                    
                    ${projectList}
                    
                    These projects showcase his skills across software development, data analysis, and IT education. You can view detailed information in the Projects section.`;
                }
                
                // Contact related questions
                if (message.includes('contact') || message.includes('email') || message.includes('phone') || message.includes('reach')) {
                    return `You can contact Fanuel through:
                    
                    - **Email**: fanuelmasuka2@gmail.com
                    - **Phone**: +263776232095 | +263718080542 
                    - **Location**: Harare, Zimbabwe
                    - **Contact Form**: Available in the Contact section of this portfolio
                    
                    He's open to discussing software development projects, data analysis work, or IT education collaborations.`;
                }
                
                // Experience related questions
                if (message.includes('experience') || message.includes('year') || message.includes('background') || message.includes('career')) {
                    return `Fanuel has over 5 years of experience in the tech industry:
                    
                    - **Software Developer**: Building robust, scalable applications using modern technologies
                    - **Data Analyst**: Transforming raw data into actionable insights for business decisions
                    - **IT Educator**: Sharing knowledge to empower the next generation of tech professionals
                    
                    His journey began with a degree in Information Systems and has evolved through various roles allowing him to hone skills across multiple domains.`;
                }
                
                // Education related questions
                if (message.includes('education') || message.includes('degree') || message.includes('learn') || message.includes('teach')) {
                    return `As an IT Educator, Fanuel:
                    
                    - Develops comprehensive curriculums for tech training programs
                    - Conducts technical workshops and training sessions
                    - Creates e-learning content and platforms
                    - Mentors aspiring developers and data analysts
                    - Designs instructional materials for various learning management systems
                    
                    He's passionate about making technology education accessible and effective.`;
                }
                
                // Greetings
                if (message.includes('hello') || message.includes('hi') || message.includes('hey') || message.includes('greeting')) {
                    return `Hello! I'm Fanuel's AI Assistant. I can help you learn more about his skills, projects, experience, and how to contact him. What would you like to know?`;
                }
                
                // Thank you
                if (message.includes('thank') || message.includes('thanks')) {
                    return `You're welcome! If you have any more questions about Fanuel's portfolio, skills, or projects, feel free to ask.`;
                }
                
                // Default response for unknown questions
                const defaultResponses = [
                    "I'm not sure I understand. Could you ask about Fanuel's skills, projects, experience, or contact information?",
                    "I'm here to help you learn more about Fanuel. You could ask about his technical skills, recent projects, or professional experience.",
                    "That's an interesting question! I specialize in providing information about Fanuel's professional background. Try asking about his software development skills, data analysis projects, or IT education experience.",
                    "I'm Fanuel's AI assistant focused on his professional portfolio. You might want to ask about his skills in PHP and JavaScript, data analysis with Python, or his experience as an IT educator."
                ];
                
                return defaultResponses[Math.floor(Math.random() * defaultResponses.length)];
            }
            
            // Auto-open chatbot after 10 seconds if user hasn't interacted
            setTimeout(() => {
                if (!isChatOpen && unreadMessages === 0) {
                    notificationBadge.textContent = '!';
                    notificationBadge.style.display = 'flex';
                    
                    // Add welcome message as unread
                    const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const welcomeMsg = `Hi there! I'm Fanuel's AI Assistant. I noticed you're viewing his portfolio. I can answer questions about his skills, projects, and experience. Click the chat button to start a conversation!`;
                    
                    // Store welcome message for when chat is opened
                    localStorage.setItem('chatbotWelcome', welcomeMsg);
                    localStorage.setItem('chatbotWelcomeTime', time);
                }
            }, 10000);
            
            // Check for stored welcome message when opening chat
            chatbotToggle.addEventListener('click', function() {
                if (isChatOpen) {
                    const storedWelcome = localStorage.getItem('chatbotWelcome');
                    const storedTime = localStorage.getItem('chatbotWelcomeTime');
                    
                    if (storedWelcome) {
                        // Add the welcome message
                        const welcomeDiv = document.createElement('div');
                        welcomeDiv.className = 'message bot-message';
                        welcomeDiv.innerHTML = `
                            ${storedWelcome}
                            <div class="message-time">${storedTime}</div>
                        `;
                        
                        // Insert after the initial greeting
                        chatbotMessages.insertBefore(welcomeDiv, chatbotMessages.children[1]);
                        
                        // Clear stored message
                        localStorage.removeItem('chatbotWelcome');
                        localStorage.removeItem('chatbotWelcomeTime');
                    }
                }
            });
            
            // Add some initial quick options
            setTimeout(() => {
                const initialOptions = [
                    "Ask about skills",
                    "View projects",
                    "Contact information",
                    "Work experience"
                ];
                
                const optionsContainer = document.createElement('div');
                optionsContainer.className = 'chatbot-options';
                
                initialOptions.forEach(option => {
                    const optionDiv = document.createElement('div');
                    optionDiv.className = 'chatbot-option';
                    optionDiv.textContent = option;
                    optionDiv.addEventListener('click', function() {
                        let question = '';
                        switch(option) {
                            case "Ask about skills": question = "What are Fanuel's skills?"; break;
                            case "View projects": question = "Tell me about his projects"; break;
                            case "Contact information": question = "How can I contact Fanuel?"; break;
                            case "Work experience": question = "What is Fanuel's experience?"; break;
                        }
                        chatInput.value = question;
                        sendMessage();
                    });
                    optionsContainer.appendChild(optionDiv);
                });
                
                // Add options to the first bot message
                const firstBotMessage = chatbotMessages.querySelector('.bot-message');
                if (firstBotMessage && !firstBotMessage.querySelector('.chatbot-options')) {
                    firstBotMessage.appendChild(optionsContainer);
                }
            }, 500);
        });
    </script>
</body>
</html>