<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV - Rabin Kumar Chaudhary</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            background: #fff;
            color: #333;
            padding: 20px;
        }
        .cv-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .text-center { text-align: center; }
        .rounded-circle {
            border-radius: 50%;
        }
        img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border: 3px solid #007bff;
        }
        h1, h2 {
            margin: 10px 0;
        }
        h2 {
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        ul {
            padding-left: 20px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="cv-container">

        {{-- Profile --}}
        <div class="text-center mb-4">
            <img src="{{ public_path('images/avatar7.png') }}" alt="Profile Photo" class="rounded-circle mb-3">
            <h1>CV - Rabin Kumar Chaudhary</h1>
            <p class="text-muted">
                rabinchaudhari@example.com<br>
                9811349989<br>
                Biratnagar, Nepal
            </p>
        </div>

        {{-- Objective --}}
        {{-- <div class="mb-4">
            <h2>Objective</h2>
            <p>To work in a dynamic and challenging environment that fosters growth and learning, while contributing effectively to the organization’s goals using my technical and soft skills.</p>
        </div> --}}

        {{-- Education --}}
        <div class="mb-4">
            <h2>Education</h2>
            <ul>
                <li><strong>Bachelor of Computer Application</strong> - Purbanchal University, 2023</li>
                <li><strong>+2 Science</strong> - Model College, 2019</li>
            </ul>
        </div>

        {{-- Skills --}}
        <div class="mb-4">
            <h2>Skills</h2>
            <ul>
                <li>Laravel & PHP</li>
                <li>JavaScript, Vue.js</li>
                <li>MySQL & Database Design</li>
                <li>HTML5, CSS3, Bootstrap</li>
                <li>Git, GitHub</li>
            </ul>
        </div>

        {{-- Experience --}}
        <div class="mb-4">
            <h2>Experience</h2>
            <ul>
                <li>
                    <strong>Web Developer Intern</strong> - XYZ Tech Company (Jan 2024 - Apr 2024)
                    <p>Assisted in the development of Laravel-based applications, collaborated in UI development and backend APIs.</p>
                </li>
                <li>
                    <strong>Freelance Projects</strong>
                    <p>Developed dynamic web applications for small businesses and portfolios.</p>
                </li>
            </ul>
        </div>

        {{-- Important Links --}}
        <div class="mb-4">
            <h2>Important Links</h2>
            <ul>
                <li><strong>Facebook:</strong> <a href="https://facebook.com/rabinchaudhari" target="_blank">facebook.com/rabinchaudhari</a></li>
                <li><strong>GitHub:</strong> <a href="https://github.com/rabinchaudhari" target="_blank">github.com/rabinchaudhari</a></li>
                <li><strong>LinkedIn:</strong> <a href="https://linkedin.com/in/rabinchaudhari" target="_blank">linkedin.com/in/rabinchaudhari</a></li>
                <li><strong>Portfolio:</strong> <a href="https://rabinchaudhari.com.np" target="_blank">rabinchaudhari.com.np</a></li>
            </ul>
        </div>

    </div>
</body>
</html>
