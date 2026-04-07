# Jenkins Job Setup Guide for Laravel + Ansible Pipeline

## Step-by-Step Instructions

### 1. Open Jenkins Dashboard

- Go to `http://localhost:8080` (or your Jenkins server URL)
- Log in with your Jenkins credentials

### 2. Create New Job

1. Click **"New Item"** (top-left menu)
2. Enter job name: `Laravel-CI-CD-Pipeline`
3. Select **"Pipeline"** as job type
4. Click **OK**

### 3. Configure Pipeline

1. Scroll down to **"Pipeline"** section
2. Select **"Pipeline script from SCM"**
3. Choose **"Git"** as SCM
4. Enter repository URL: `https://github.com/your-username/your-repo.git`
5. Set branch to: `*/main` (or your default branch)
6. Set script path to: `laravel_Jenkins/Jenkinsfile`
7. Click **Save**

### 4. Alternative: Direct Jenkinsfile Configuration

If you want to use the Jenkinsfile directly in Jenkins:

1. In job configuration → **Pipeline** section
2. Select **"Pipeline script"** (instead of SCM)
3. Copy the entire contents of `laravel_Jenkins/Jenkinsfile` into the script area
4. Click **Save**

### 5. Test the Job

1. Click **"Build Now"** to trigger a manual build
2. Monitor build progress in **Build History** (left sidebar)
3. Click build number to view console output

### 6. Automatic Triggers (Optional)

The Jenkinsfile already has `pollSCM('* * * * *')` which runs every 1 minute.

To use GitHub webhooks instead:

1. Go to job configuration
2. Check **"GitHub hook trigger for GITScm polling"**
3. Set GitHub webhook URL: `http://your-jenkins-server/github-webhook/`

---

## Project Structure Required

Your repository should have:

```
TP3/
├── .env.example          ✅ Created
├── laravel_Jenkins/
│   └── Jenkinsfile      ✅ Your Jenkinsfile
├── agent/
│   └── dockerfile       ✅ Docker image definition
├── inventory/
│   └── hosts.ini        ✅ Ansible inventory
├── deploy.yml           ✅ Ansible playbook
├── app/
├── config/
├── resources/
├── routes/
├── tests/
├── vendor/
└── ... (other Laravel files)
```

---

## Troubleshooting

### Error: "No such file or directory: .env.example"

- Ensure `.env.example` exists in your project root
- ✅ Already created

### Error: "ansible-playbook: command not found"

- Verify Ansible is installed in Docker image
- ✅ Already added to agent/dockerfile

### Error: "Docker agent not connecting"

1. Ensure Docker daemon is running
2. Check Docker socket permissions: `docker ps`
3. Verify Jenkins can access Docker

### Build fails on `npm install`

- Node.js is not in the Dockerfile
- Comment out npm line in Jenkinsfile or add Node.js to Dockerfile

---

## Pipeline Execution Flow

```
Every 1 minute (pollSCM)
    ↓
[Build Stage]
  ├─ Copy .env.example to .env
  ├─ Setup database variables
  ├─ composer install
  └─ php artisan key:generate
    ↓
[Test Stage]
  ├─ Run phpunit tests
  └─ php artisan test
    ↓
[Deploy Stage]
  ├─ ansible-playbook deploy.yml
  └─ Echo deployment status
    ↓
[Post Actions]
  ├─ Clean workspace
  └─ Report success/failure
```

---

## Running the Pipeline

### Manual Trigger

```bash
# In Jenkins UI: Click "Build Now"
```

### From Command Line (using Jenkins CLI)

```bash
java -jar jenkins-cli.jar -s http://localhost:8080 build Laravel-CI-CD-Pipeline
```

### View Build Logs

1. Click buildnumber in Jenkins UI
2. View console output in real-time

---

## Key Files Status

✅ `.env.example` - Created  
✅ `laravel_Jenkins/Jenkinsfile` - Ready  
✅ `agent/dockerfile` - Docker image with PHP 8.2, Composer, Ansible, SSH  
✅ `inventory/hosts.ini` - Ansible hosts configuration  
✅ `deploy.yml` - Ansible deployment playbook

**All set! Your Jenkins Pipeline is ready to use.** 🚀
