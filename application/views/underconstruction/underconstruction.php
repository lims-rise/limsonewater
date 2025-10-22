<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterolert Hemoflow - Under Construction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #a8d0f0 0%, #c5e3f7 100%);
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        
        .construction-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .construction-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            max-width: 600px;
            width: 100%;
        }
        
        .construction-icon {
            font-size: 120px;
            color: #6bb6d6;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
        
        .construction-title {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #6bb6d6, #a8d0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .construction-subtitle {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 30px;
            font-weight: 300;
        }
        
        .construction-description {
            font-size: 1.1rem;
            color: #777;
            line-height: 1.6;
            margin-bottom: 40px;
        }
        
        .progress-container {
            margin: 40px 0;
        }
        
        .progress {
            height: 20px;
            border-radius: 10px;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #6bb6d6, #a8d0f0);
            border-radius: 10px;
            animation: progressFill 3s ease-in-out infinite;
        }
        
        @keyframes progressFill {
            0% { width: 0%; }
            50% { width: 85%; }
            100% { width: 0%; }
        }
        
        .features-list {
            text-align: left;
            margin: 30px 0;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin: 15px 0;
            font-size: 1.1rem;
            color: #555;
        }
        
        .feature-icon {
            color: #6bb6d6;
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .back-button {
            background: linear-gradient(135deg, #6bb6d6, #a8d0f0);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(107, 182, 214, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .logo-container {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-container img {
            height: 50px;
        }
        
        .countdown {
            font-size: 1.2rem;
            color: #6bb6d6;
            font-weight: bold;
            margin: 20px 0;
        }
        
        @media (max-width: 768px) {
            .construction-card {
                padding: 40px 20px;
                margin: 20px;
            }
            
            .construction-title {
                font-size: 2.5rem;
            }
            
            .construction-icon {
                font-size: 80px;
            }
            
            .logo-container {
                position: static;
                justify-content: center;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Logo Container -->
    <div class="logo-container">
        <img src="<?= base_url('img/onewaterlogo.png') ?>" alt="OneWater Logo">
        <!-- <img src="<?= base_url('img/monash.png') ?>" alt="Monash Logo"> -->
    </div>

    <div class="construction-container">
        <div class="construction-card">
            <!-- Construction Icon -->
            <div class="construction-icon">
                <i class="fas fa-hard-hat"></i>
            </div>
            
            <!-- Title -->
            <h1 class="construction-title">Under Construction</h1>
            
            <!-- Subtitle -->
            <!-- <h2 class="construction-subtitle">Enterolert Hemoflow Module</h2> -->
            
            <!-- Description -->
            <p class="construction-description">
                We're working hard to bring you an amazing new experience with our advanced testing modules. 
                These comprehensive modules will provide enhanced analysis and management capabilities for your laboratory workflows.
            </p>
            
            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" style="width: 75%"></div>
                </div>
                <div class="countdown">
                    <i class="fas fa-clock"></i> Development Progress
                </div>
            </div>
            
            <!-- Features List -->
            <!-- <div class="features-list">
                <h4 style="color: #333; margin-bottom: 20px; text-align: center;">
                    <i class="fas fa-star"></i> Coming Soon Features
                </h4>
                <div class="feature-item">
                    <i class="fas fa-vial feature-icon"></i>
                    <span>Advanced Sample Processing & Analysis</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-chart-line feature-icon"></i>
                    <span>Real-time Data Visualization & Reporting</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-database feature-icon"></i>
                    <span>Comprehensive Data Management System</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-users feature-icon"></i>
                    <span>Multi-user Collaboration & Review System</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <span>Enhanced Quality Control & Validation</span>
                </div>
            </div> -->
            
            <!-- Back Button -->
            <a href="javascript:history.back()" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            
            <!-- Additional Info -->
            <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
                <p style="color: #999; font-size: 0.9rem; margin: 0;">
                    <i class="fas fa-info-circle"></i> 
                    For questions or updates, please contact the development team.
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate feature items on scroll/load
            const featureItems = document.querySelectorAll('.feature-item');
            featureItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-30px)';
                item.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, index * 200 + 500);
            });
            
            // Dynamic progress update (for demo)
            const progressBar = document.querySelector('.progress-bar');
            let progress = 15;
            
            // setInterval(() => {
            //     progress = Math.min(progress + Math.random() * 2, 90);
            //     progressBar.style.width = progress + '%';
            //     document.querySelector('.countdown').innerHTML = 
            //         '<i class="fas fa-clock"></i> Development Progress: ' + Math.floor(progress) + '%';
            // }, 5000);
        });
    </script>
</body>
</html>