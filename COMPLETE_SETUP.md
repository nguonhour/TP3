# TP3 Complete Setup Guide - Email, Telegram & Production Deployment

## 📋 Prerequisites

Before starting, you need:

- Jenkins server (running)
- GitHub repository access
- Production server IP: `178.128.93.188`
- Email account (Gmail, Outlook, etc.)
- Telegram bot token (optional)

---

## 📧 **Part 1: Configure Email Notifications**

### Step 1: Install Email Extension Plugin in Jenkins

1. Go to: `http://localhost:8080/manage/pluginManager/available`
2. Search: `Email Extension`
3. Check the box ✅
4. Click **Install without restart**

### Step 2: Configure Jenkins Email Settings

1. Go to **Manage Jenkins** → **System**
2. Find **Extended E-mail Notification** section
3. Configure:

```
SMTP Server: smtp.gmail.com
SMTP Port: 587
Default user E-mail suffix: @gmail.com
Enable SMTP Authentication: ✅
Username: your-email@gmail.com
Password: your-app-password
Use TLS: ✅
```

### Step 3: For Gmail Users

1. Enable 2-Factor Authentication in Google Account
2. Generate App Password at: https://myaccount.google.com/apppasswords
3. Use the 16-character App Password in Jenkins

### Step 4: Test Email

In Jenkins job configuration → **Post-Build Actions**:

- Add build step: `Send emails to 'developers' for broken builds`
- Test by triggering a build

---

## 📱 **Part 2: Configure Telegram Notifications**

### Step 1: Create Telegram Bot

1. Open Telegram and find **@BotFather**
2. Send: `/newbot`
3. Follow prompts to create a bot
4. Copy the **Bot Token** (looks like: `123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11`)

### Step 2: Get Your Telegram Chat ID

1. Create a Telegram group or use Direct Message
2. Send any message to bot
3. Go to: `https://api.telegram.org/bot{BOT_TOKEN}/getUpdates`
4. Replace `{BOT_TOKEN}` with your actual token
5. Find `"chat":{"id":123456789}` - that's your Chat ID

### Step 3: Add Telegram Credentials to Jenkins

1. Go to **Manage Jenkins** → **Credentials**
2. Click **System** → **Global credentials**
3. Add credentials:
   - Kind: Secret text
   - Secret: Your Bot Token
   - ID: `TELEGRAM_BOT_TOKEN`

4. Add another credential for Chat ID:
   - Kind: Secret text
   - Secret: Your Chat ID (123456789)
   - ID: `TELEGRAM_CHAT_ID`

### Step 4: Update Jenkins Environment Variables

1. Go to **Manage Jenkins** → **System** → **Environment Variables**
2. Add:
   - `TELEGRAM_BOT_TOKEN` = Your Bot Token
   - `TELEGRAM_CHAT_ID` = Your Chat ID

---

## 🚀 **Part 3: Configure Production Deployment (178.128.93.188)**

### Step 1: Setup SSH Access to Production Server

```bash
# Generate SSH key for server
ssh-keygen -t rsa -b 4096 -f production_key -N ""

# Copy public key to server
ssh-copy-id -i production_key.pub root@178.128.93.188

# Test SSH connection
ssh -i production_key root@178.128.93.188
```

### Step 2: Install Requirements on Production Server

Connect to the server and run:

```bash
ssh -i production_key root@178.128.93.188

# Update package manager
apt-get update && apt-get upgrade -y

# Install PHP and dependencies
apt-get install -y php8.2-fpm php8.2-mysql php8.2-mbstring \
  php8.2-xml php8.2-zip php8.2-curl php8.2-gd

# Install Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Install Git
apt-get install -y git

# Install Ansible (for agent)
apt-get install -y ansible

# Create app directory
mkdir -p /var/www/html
cd /var/www/html

# Install Laravel project
git clone https://github.com/nguonhour/TP3.git /var/www/html/tp3

# Navigate to the Laravel app
cd laravel_Jenkins

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data .

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 3: if you forget install php in step 2
```
sudo nano /etc/nginx/sites-available/laravel
```
```
# heng_nguonhour TP3 Laravel application
location /heng_nguonhour {
    alias /var/www/html/heng_nguonhour/public;
    try_files $uri $uri/ @heng_nguonhour;

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $request_filename;
    }
}

location @heng_nguonhour {
    rewrite /heng_nguonhour/(.*)$ /heng_nguonhour/index.php?/$1 last;
}
```
---

## 🔄 **Complete Workflow**

1. **Developer pushes code** to GitHub
2. ✅ **Jenkins polls every 1 minute** and detects changes
3. ✅ **Pipeline runs**: Setup → Build → Test → Deploy
4. ✅ **Deployment stages**:
   - Local deployment (if needed)
   - Production deployment to 178.128.93.188
5. ✅ **Notifications sent**:
   - Email to developers
   - Telegram to team chat

---

## 📝 **Environment Variables for Jenkins**

Add these to **Manage Jenkins** → **System** → **Environment Variables**:

```
TELEGRAM_BOT_TOKEN = your-bot-token-here
TELEGRAM_CHAT_ID = your-chat-id-here
DEFAULT_RECIPIENTS = your-email@gmail.com
PRODUCTION_SERVER = 178.128.93.188
```

---

## ✅ **Verification Checklist**

After setup, verify:

- [ ] Email Extension plugin installed
- [ ] Telegram bot created and chat ID obtained
- [ ] SSH key generated for production server
- [ ] SSH access to 178.128.93.188 working
- [ ] Ansible inventory updated with production server
- [ ] Jenkins environment variables set
- [ ] Build triggered manually and completed
- [ ] Email notification received
- [ ] Telegram notification received
- [ ] Production deployment successful

---

## 🐛 **Troubleshooting**

### Email not sending

- Check Gmail 2FA and App Password
- Verify SMTP settings in Jenkins
- Check Jenkins log: `/var/log/jenkins/jenkins.log`

### Telegram not working

- Verify bot token and chat ID
- Go to: `https://api.telegram.org/bot{TOKEN}/getMe`
- Should return bot info

### SSH connection fails

- Verify key permissions: `chmod 600 production_key`
- Test: `ssh -i production_key root@178.128.93.188`
- Check server firewall settings

### Ansible deployment fails

- Run with verbose: `ansible-playbook -i inventory/hosts.ini deploy.yml -vvv`
- Check production server has all requirements
- Verify PHP-FPM and Nginx are running

---

## 🎯 **Your TP3 Assignment is Now Complete!**

✅ All requirements met:

1. ✅ Jenkins initialized and running
2. ✅ Ansible agent configured
3. ✅ Jenkinsfile with build pipeline
4. ✅ **Email notifications on error** ← Added
5. ✅ **Telegram notifications** ← Added
6. ✅ **Deployment to 178.128.93.188** ← Added

Ready to submit! 🚀
