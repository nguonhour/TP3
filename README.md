# TP3: Jenkins & Ansible CI/CD Pipeline for Laravel

Complete DevOps setup for automated Laravel deployment with Jenkins and Ansible.

## 📋 TP3 Requirements

✅ 1. Create Laravel project (via CI/CD pipeline)
✅ 2. Create Laravel SSH agent (Docker container with Jenkins SSH user)
✅ 3. Connect Jenkins to agent (SSH-based agent connection)
✅ 4. Create Jenkins file (Jenkinsfile with build/test/deploy stages)
✅ 5. Schedule job run **every 1 minute** (pollSCM('\* \* \* \* \*'))

---

## 🚀 Quick Start

### Step 1: Build Docker Agent

```bash
docker build -f agent/dockerfile -t laravel-jenkins-agent .
```

### Step 2: Run Container (SSH + PHP-FPM)

```bash
docker run -d -p 2222:22 -p 9000:9000 --name laravel-agent laravel-jenkins-agent
```

### Step 3: Generate SSH Keys

```bash
ssh-keygen -t rsa -b 4096 -f jenkins_rsa -N ""
```

### Step 4: Setup Jenkins Job

1. Open Jenkins: `http://localhost:8080`
2. New Item → Pipeline
3. Configure with Git repository + Jenkinsfile path
4. **See [JENKINS_SETUP.md](JENKINS_SETUP.md) for detailed steps**

---

## 📝 Pipeline Overview

```
Every 1 minute (pollSCM)
    ↓
┌─────────────────┐
│  BUILD STAGE    │ - Copy .env.example → .env
├─────────────────┤   - composer install
│  TEST STAGE     │ - php artisan key:generate
├─────────────────┤
│ DEPLOY STAGE    │ - Run Ansible playbook
├─────────────────┤   - Database migrations
│ POST ACTIONS    │   - Cache clear & optimize
└─────────────────┘
```

---

## 📁 Project Structure

```
TP3/
├── .env.example                    # ✅ Laravel environment template
├── JENKINS_SETUP.md               # ✅ Jenkins configuration guide
├── README.md                       # ✅ This file
├── laravel_Jenkins/
│   └── Jenkinsfile                # ✅ Pipeline definition
├── agent/
│   └── dockerfile                 # ✅ Docker build agent image
├── inventory/
│   └── hosts.ini                  # ✅ Ansible hosts
├── deploy.yml                      # ✅ Ansible playbook
└── ... (Laravel project files)
```

---

## 🔧 Key Features

### Docker Agent (agent/dockerfile)

- PHP 8.2-FPM
- Composer 2
- Ansible for deployment
- SSH Server (port 22)
- PHP-FPM (port 9000)
- All Laravel dependencies

### Jenkins Pipeline (laravel_Jenkins/Jenkinsfile)

- **Build Stage**: Dependencies & key generation
- **Test Stage**: PHPUnit + Laravel tests
- **Deploy Stage**: Ansible-based deployment
- **Triggers**: Runs every 1 minute

### Ansible Playbook (deploy.yml)

- Git pull latest code
- Composer install
- Database migrations
- Cache clearing
- Application optimization
- File permissions
- PHP-FPM restart

---

## ⏰ Scheduling Details

**Polling Interval**: `pollSCM('* * * * *')` = **Every 1 minute**

To modify in Jenkinsfile:

```groovy
triggers {
    pollSCM('H/5 * * * *')  // Every 5 minutes
    // OR
    githubPush()             // Instant webhook trigger
}
```

---

## 🔐 SSH Agent Connection

The Jenkins agent runs inside Docker with:

- **User**: `jenkins`
- **Port**: `2222` (mapped to container's 22)
- **Home**: `/home/jenkins`
- **SSH Config**: Preset for agent forwarding

---

## 📚 Full Documentation

See **[JENKINS_SETUP.md](JENKINS_SETUP.md)** for:

- Detailed Jenkins job creation steps
- Troubleshooting guide
- Credential management
- Build log examples

---

## ✅ Completion Status

All requirements completed and tested:

- [x] Laravel SSH agent Docker image
- [x] Jenkinsfile with all stages
- [x] Ansible deployment automation
- [x] 1-minute job scheduling
- [x] Documentation & setup guides

**Ready for Jenkins deployment! 🚀**
