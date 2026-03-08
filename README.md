# HEDS – High End Digital Services

A PHP + Angular.js portfolio website for a digital-agency.  
The application is served by Apache and uses [Mailgun](https://www.mailgun.com/) for the contact form.

---

## Environment variables

Copy `.env.example` to `.env` and set the values:

| Variable | Description |
|----------|-------------|
| `MAILGUN_API_KEY` | Your Mailgun private API key |
| `MAILGUN_DOMAIN` | The sending domain registered in Mailgun |
| `MAIL_RECIPIENT` | Email address that receives contact-form messages (default: `info@heds.com`) |

---

## Deployment options

### Option 1 – Render (recommended, no Docker needed)

[Render](https://render.com) can host the application for free with zero infrastructure to manage.

**Prerequisites**
- A free [Render account](https://dashboard.render.com/register)
- A free [Mailgun account](https://signup.mailgun.com/) for the contact form

**Steps**

1. Fork or push this repository to your GitHub / GitLab account.

2. In the Render dashboard click **New → Web Service** and connect your repository.  
   Render will automatically detect `render.yaml` and pre-fill the settings.

3. Set the three environment variables in **Settings → Environment**:

   | Variable | Value |
   |----------|-------|
   | `MAILGUN_API_KEY` | Your Mailgun private API key |
   | `MAILGUN_DOMAIN`  | Your Mailgun sending domain |
   | `MAIL_RECIPIENT`  | Email that receives contact messages |

4. Click **Deploy**. Render will:
   - Run `composer install` in `backend/`
   - Start the app with PHP's built-in server via `router.php`

5. Your site will be live at `https://<your-service-name>.onrender.com`.

> **Alternative**: click the button below to deploy with one click (requires the repo to be public).  
> [![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://render.com/deploy)

---

### Option 2 – Hostinger via GitHub Actions (automated FTP deployment)

Every push to the `main` branch automatically deploys the latest code to
Hostinger using the workflow in `.github/workflows/deploy.yml`.

**One-time setup**

1. In your GitHub repository go to **Settings → Secrets and variables → Actions**
   and create the following repository secrets:

   | Secret name | Value |
   |-------------|-------|
   | `FTP_SERVER` | Your Hostinger FTP hostname or IP address |
   | `FTP_USERNAME` | Your Hostinger FTP username |
   | `FTP_PASSWORD` | Your Hostinger FTP account password |

2. The workflow uses these secrets to connect on port `21` and upload files to
   the `/public_html/` directory on the remote server.

3. After the first deploy, create a `.env` file in `public_html/` on the server
   (via Hostinger File Manager or SSH) with the required environment variables
   (see the **Environment variables** section above).

> **Note**: `backend/vendor/` is installed during the CI step and uploaded
> automatically. Docker and Render-specific files (`Dockerfile`,
> `docker-compose.yml`, `render.yaml`, `router.php`) are excluded from the
> upload.

---

### Option 3 – Hostinger shared hosting (manual FTP)

Hostinger's shared hosting plans include PHP 8.x and Apache/LiteSpeed, so the
application runs without any containers.

**Prerequisites**
- A [Hostinger](https://www.hostinger.com) shared hosting plan (Business or higher recommended for SSH access)
- A free [Mailgun account](https://signup.mailgun.com/) for the contact form

**Steps**

1. **Upload the project files**

   Using Hostinger's **File Manager** or an FTP client (e.g. FileZilla), upload all
   project files into the `public_html/` directory of your hosting account.
   The resulting layout should be:

   ```
   public_html/
   ├── .htaccess          ← ships with this repo; handles URL routing
   ├── frontend/
   ├── backend/
   ├── assets/
   ├── css/
   ├── js/
   ├── img/
   └── logo/
   ```

2. **Install Composer dependencies**

   Hostinger Business plans include SSH access.  Connect and run:

   ```bash
   cd ~/public_html/backend
   composer install --no-dev --optimize-autoloader --no-interaction
   ```

   If your plan has no SSH access, run `composer install` locally and upload the
   generated `backend/vendor/` folder together with the other files.

3. **Configure environment variables**

   Copy `.env.example` to `.env` inside `public_html/`:

   ```bash
   cp .env.example .env
   # Then edit .env and fill in MAILGUN_API_KEY, MAILGUN_DOMAIN, MAIL_RECIPIENT
   ```

   The contact-form back-end automatically reads this file on hosts where the
   variables are not injected by the platform.

   > **Security note**: the bundled `.htaccess` already blocks direct HTTP access
   > to `.env`. Never commit real credentials to version control.

4. **Point your domain**

   In the Hostinger panel under **Domains → Manage**, ensure your domain's
   document root is set to `public_html/`. The `.htaccess` file takes care of
   all URL rewriting – no additional Apache configuration is needed.

5. Open your domain in a browser and verify the site loads correctly.

---

### Option 4 – Docker (local development / VPS)

**Requirements**

| Tool | Minimum version |
|------|----------------|
| Docker | 20.10+ |
| Docker Compose | v2 |

> No PHP or Composer installation is required on the host.

```bash
# 1. Clone the repository
git clone https://github.com/Karugaba118/HEDS.git
cd HEDS

# 2. Create your environment file
cp .env.example .env
# Edit .env and fill in MAILGUN_API_KEY, MAILGUN_DOMAIN, MAIL_RECIPIENT

# 3. Build and start the container
docker compose up --build -d

# 4. Open the application
#    http://localhost:8080
```

Stop the application:

```bash
docker compose down
```

To expose the site on port 80, change the port mapping in `docker-compose.yml`:

```yaml
ports:
  - "80:80"
```

---

## Project structure

```
HEDS/
├── .github/
│   └── workflows/
│       └── deploy.yml     # GitHub Actions – FTP deploy to Hostinger on push to main
├── .htaccess          # Apache/LiteSpeed URL rewrite rules (Hostinger)
├── router.php         # PHP built-in server router (Render)
├── render.yaml        # Render Blueprint – one-click deployment config
├── frontend/          # PHP view templates (Angular.js SPA entry point: index.php)
├── backend/           # PHP back-end (contact-form handler, Composer dependencies)
│   ├── contact-form.php
│   ├── composer.json
│   └── vendor/
├── assets/            # Third-party libraries (Bootstrap, AOS, Angular, jQuery …)
├── css/               # Custom stylesheets
├── js/                # Custom JavaScript
├── img/               # Image assets
├── logo/              # Brand assets
├── docker/            # Docker support files
│   └── apache.conf    # Apache virtual-host configuration
├── Dockerfile
├── docker-compose.yml
└── .env.example
```
