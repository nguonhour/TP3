<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heng Nguonhour - TP3 DevOps Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #667eea;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .requirements {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .requirement {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }

        .requirement.enhancement {
            border-left-color: #ffc107;
        }

        .requirement h3 {
            color: #333;
            margin-bottom: 5px;
            font-size: 1.1em;
        }

        .requirement p {
            font-size: 0.95em;
            color: #666;
        }

        .tech-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .tech-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-top: 3px solid #667eea;
        }

        .tech-item strong {
            display: block;
            color: #667eea;
            margin-bottom: 5px;
        }

        .tech-item small {
            color: #999;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
        }

        .btn:hover {
            background: #764ba2;
        }

        .btn-secondary {
            background: #28a745;
        }

        .btn-secondary:hover {
            background: #218838;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .stat .number {
            font-size: 2em;
            color: #667eea;
            font-weight: bold;
        }

        .stat .label {
            color: #666;
            margin-top: 5px;
        }

        footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #ddd;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 1.8em;
            }

            .requirements {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>🚀 TP3 DevOps CI/CD Pipeline</h1>
            <p>Jenkins, Docker, Ansible & Laravel - Complete Production Deployment</p>
        </header>

        <div class="content">
            <!-- About Section -->
            <div class="section">
                <h2>👤 About This Project</h2>
                <p><strong>Student:</strong> ហេង ងួន ហ៊ួរ (Heng Nguonhour)</p>
                <p><strong>Course:</strong> Year 4 DevOps - TP3 Assignment</p>
                <p><strong>Objective:</strong> Build a complete CI/CD pipeline with automated deployment, notifications,
                    and production server.</p>
            </div>

            <!-- Stats Section -->
            <div class="section">
                <h2>📊 Project Statistics</h2>
                <div class="stats">
                    <div class="stat">
                        <div class="number">5</div>
                        <div class="label">Core Requirements</div>
                    </div>
                    <div class="stat">
                        <div class="number">3</div>
                        <div class="label">Enhancements</div>
                    </div>
                    <div class="stat">
                        <div class="number">100%</div>
                        <div class="label">Complete</div>
                    </div>
                    <div class="stat">
                        <div class="number">1 min</div>
                        <div class="label">Deploy Frequency</div>
                    </div>
                </div>
            </div>

            <!-- Requirements Section -->
            <div class="section">
                <h2>✅ Core Requirements (5/5)</h2>
                <div class="requirements">
                    <div class="requirement">
                        <h3>✓ Laravel Project</h3>
                        <p>Full-stack web application with MVC architecture</p>
                    </div>
                    <div class="requirement">
                        <h3>✓ SSH Agent</h3>
                        <p>Docker-based Jenkins agent with PHP 8.2, Composer, Ansible</p>
                    </div>
                    <div class="requirement">
                        <h3>✓ Jenkins Setup</h3>
                        <p>Pipeline orchestration with GitHub integration</p>
                    </div>
                    <div class="requirement">
                        <h3>✓ Jenkinsfile</h3>
                        <p>Infrastructure-as-Code with Setup → Build → Test → Deploy</p>
                    </div>
                    <div class="requirement">
                        <h3>✓ Auto-Deploy</h3>
                        <p>SCM polling every 1 minute for continuous deployment</p>
                    </div>
                </div>

                <h2 style="margin-top: 30px;">🎁 Enhancements (3/3 - Option D)</h2>
                <div class="requirements">
                    <div class="requirement enhancement">
                        <h3>✓ Email Notifications</h3>
                        <p>Gmail SMTP alerts on build success/failure</p>
                    </div>
                    <div class="requirement enhancement">
                        <h3>✓ Telegram Alerts</h3>
                        <p>Real-time bot notifications to team chat</p>
                    </div>
                    <div class="requirement enhancement">
                        <h3>✓ Production Deploy</h3>
                        <p>Live deployment to 178.128.93.188 via Ansible</p>
                    </div>
                </div>
            </div>

            <!-- Technology Stack Section -->
            <div class="section">
                <h2>🛠️ Technology Stack</h2>
                <div class="tech-grid">
                    <div class="tech-item">
                        <strong>Laravel</strong>
                        <small>Web Framework</small>
                    </div>
                    <div class="tech-item">
                        <strong>PHP 8.2</strong>
                        <small>Language</small>
                    </div>
                    <div class="tech-item">
                        <strong>Jenkins</strong>
                        <small>CI/CD Engine</small>
                    </div>
                    <div class="tech-item">
                        <strong>Docker</strong>
                        <small>Containerization</small>
                    </div>
                    <div class="tech-item">
                        <strong>Ansible</strong>
                        <small>Automation</small>
                    </div>
                    <div class="tech-item">
                        <strong>GitHub</strong>
                        <small>Repository</small>
                    </div>
                    <div class="tech-item">
                        <strong>Nginx</strong>
                        <small>Web Server</small>
                    </div>
                    <div class="tech-item">
                        <strong>Composer</strong>
                        <small>Package Manager</small>
                    </div>
                </div>
            </div>

            <!-- Pipeline Flow Section -->
            <div class="section">
                <h2>🔄 Deployment Pipeline</h2>
                <div
                    style="background: #f8f9fa; padding: 20px; border-radius: 8px; font-family: monospace; line-height: 2;">
                    <div>📝 Code Push to GitHub</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>🔍 Jenkins Detects Change (every 1 min)</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>⚙️ Stage 1: Setup - Environment Configuration</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>🔨 Stage 2: Build - Dependency Installation</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>✔️ Stage 3: Test - Framework Validation</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>🚀 Stage 4: Deploy - Production Deployment via Ansible</div>
                    <div style="color: #999; margin-left: 20px;">↓</div>
                    <div>📧 Email Notification + 💬 Telegram Alert</div>
                </div>
            </div>

            <!-- Links Section -->
            <div class="section">
                <h2>🔗 Quick Links</h2>
                <div class="links">
                    <a href="https://github.com/nguonhour/TP3.git" target="_blank" class="btn">GitHub Repository</a>
                    <a href="http://localhost:8080/job/Laravel-CI-CD-Pipeline/" target="_blank"
                        class="btn btn-secondary">Jenkins Dashboard</a>
                    <a href="https://github.com/nguonhour/TP3/blob/main/PORTFOLIO.md" target="_blank" class="btn">Full
                        Portfolio</a>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="section">
                <h2>📞 Contact Information</h2>
                <p><strong>Name:</strong> ហេង ងួន ហ៊ួរ (Heng Nguonhour)</p>
                <p><strong>Email:</strong> hengnguonhour@gmail.com</p>
                <p><strong>GitHub:</strong> <a href="https://github.com/nguonhour"
                        target="_blank">github.com/nguonhour</a></p>
            </div>
        </div>

        <footer>
            <p>✨ TP3 DevOps Portfolio • April 7, 2026 • Complete & Production-Ready</p>
        </footer>
    </div>
</body>

</html>