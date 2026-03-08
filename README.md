# HEDS – High End Digital Services

[![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://render.com/deploy)

**HEDS (High End Digital Services)** is a PHP + Angular.js portfolio website for a digital agency based in Kampala, Uganda. The site showcases the agency's services, portfolio, and blog, and includes a fully integrated contact form powered by [Mailgun](https://www.mailgun.com/).

---

## Table of Contents

- [Project Overview](#project-overview)
- [Key Features](#key-features)
- [Technology Stack](#technology-stack)
- [Project Structure](#project-structure)
- [Frontend Pages & Components](#frontend-pages--components)
- [Backend & API](#backend--api)
- [Environment Variables](#environment-variables)
- [Getting Started (Local Development)](#getting-started-local-development)
- [Deployment Options](#deployment-options)

---

## Project Overview

The application is a **Single Page Application (SPA)** built with Angular.js for client-side routing, with PHP serving the HTML templates and handling the contact form. Apache or PHP's built-in server delivers the content depending on the deployment target.

**Services offered by the agency:**
1. Web Design & Development
2. App Development (iOS & Android)
3. Graphics Design
4. Video Editing
5. SEO & Online Advertising
6. Roadside Banner Ads
7. Branding

---

## Key Features

- **SPA routing** via Angular.js and `angular-route` – no page reloads between views
- **Responsive design** built on Bootstrap 5, mobile-first
- **Scroll animations** powered by the AOS (Animate On Scroll) library
- **Animated statistics counters** using PureCounter
- **Portfolio gallery** with category filtering (Isotope) and image lightbox
- **3D tilt card effect** on the Services overview page
- **Blog system** with a per-post like counter stored in browser `localStorage`
- **Contact form** with server-side validation and Mailgun email delivery
- **Back-to-top button** with a circular scroll-progress indicator
- **Dark-themed design** with orange (`#fb8500`) and cyan (`#00ffff`) accents

---

## Technology Stack

| Layer | Technology |
|-------|-----------|
| **Server language** | PHP 8.2 |
| **Web server** | Apache (Docker / Hostinger) · PHP built-in server (Render) |
| **Frontend framework** | Angular.js + angular-route |
| **UI framework** | Bootstrap 5 |
| **Icons** | Bootstrap Icons |
| **Animations** | AOS, PureCounter |
| **Layout** | Isotope Layout |
| **DOM utilities** | jQuery |
| **Email delivery** | Mailgun API |
| **PHP HTTP client** | Guzzle 7 (via `php-http/guzzle7-adapter`) |
| **PSR standards** | PSR-7 (Nyholm), PSR-17 |
| **Containerisation** | Docker (PHP 8.2-Apache image) |
| **Dependency management** | Composer 2 |

---

## Project Structure

```
HEDS/
├── frontend/                  # PHP view templates (Angular.js SPA)
│   ├── index.php              # SPA shell – loads Angular, navbar & footer
│   ├── home.php               # Home / landing page
│   ├── about.php              # About the agency
│   ├── services.php           # Services overview (3D flip cards)
│   ├── web-design.php         # Web Design service detail
│   ├── app-development.php    # App Development service detail
│   ├── graphics-design.php    # Graphics Design service detail
│   ├── video-editing.php      # Video Editing service detail
│   ├── seo-ads.php            # SEO & Online Ads service detail
│   ├── roadside-banner.php    # Roadside Banner service detail
│   ├── branding.php           # Branding service detail
│   ├── portfolio.php          # Portfolio showcase with category filtering
│   ├── blog.php               # Blog listing
│   ├── blog-detail.php        # Individual blog post (dynamic via :topicId)
│   ├── contact.php            # Contact form
│   └── terms.php              # Terms & Conditions
│
├── backend/
│   ├── contact-form.php       # Contact form API endpoint (POST only)
│   ├── composer.json          # PHP package manifest
│   ├── composer.lock
│   └── vendor/                # Composer-installed packages
│
├── assets/
│   ├── angular/               # Angular.js & angular-route
│   ├── bootstrap/             # Bootstrap CSS & JS bundle
│   ├── bootstrap-icons/       # Bootstrap icon font
│   ├── aos/                   # Animate On Scroll
│   ├── j-query/               # jQuery
│   ├── purecounter/           # Counter animation
│   ├── isotope-layout/        # Portfolio grid filtering
│   └── includes/              # Shared PHP partials
│       ├── navigationbar.php  # Fixed header with mobile hamburger & Services dropdown
│       ├── footer.php         # Footer: columns, social icons, copyright
│       └── backtop.php        # Back-to-top button with scroll-progress ring
│
├── css/
│   └── style.css              # Main custom stylesheet (~2,000 lines)
│
├── js/
│   ├── app.js                 # Angular.js app module, routing config & controllers
│   └── main.js                # jQuery plugins, AOS init, FAQ toggles, counters
│
├── img/                       # Image assets (organised by page/section)
├── logo/                      # Brand assets (logo.png, page_icon.png)
│
├── docker/
│   └── apache.conf            # Apache VirtualHost config for Docker
│
├── .htaccess                  # Apache/LiteSpeed URL rewrite rules & .env protection
├── router.php                 # PHP built-in server router (used on Render)
├── Dockerfile                 # PHP 8.2-Apache container image
├── docker-compose.yml         # Docker Compose service definition
├── render.yaml                # Render Blueprint – one-click deployment
└── .env.example               # Environment variable template
```

---

## Frontend Pages & Components

### Layout Components (shared across all pages)

| Component | File | Description |
|-----------|------|-------------|
| Navigation bar | `assets/includes/navigationbar.php` | Fixed top header, logo, hamburger menu, Services dropdown |
| Footer | `assets/includes/footer.php` | 4-column layout, social media links, dynamic copyright year |
| Back-to-top | `assets/includes/backtop.php` | Fixed scroll-progress ring button |

### Pages

| Page | Route | Key Sections |
|------|-------|-------------|
| Home | `/` | Hero banner, intro, service cards, call-to-action |
| About | `/about.php` | Company story, mission, values |
| Services | `/services.php` | 3D flip cards with Tilt.js for each service |
| Web Design | `/web-design.php` | Stats counters, benefits grid, process steps |
| App Development | `/app-development.php` | Tech stack, feature highlights |
| Graphics Design | `/graphics-design.php` | Design categories, samples |
| Video Editing | `/video-editing.php` | Editing types, sample reel |
| SEO & Ads | `/seo-ads.php` | Strategy overview, ad platforms |
| Roadside Banner | `/roadside-banner.php` | Banner types, design options |
| Branding | `/branding.php` | Brand identity elements |
| Portfolio | `/portfolio.php` | Isotope-filtered gallery (Web, Apps, Graphics), image modal |
| Blog | `/blog.php` | Featured post, blog cards, category tags |
| Blog Detail | `/blog-detail.php/:topicId` | Full article, `localStorage` like system, related posts |
| Contact | `/contact.php` | Form with topic dropdown, contact information sidebar |
| Terms | `/terms.php` | Terms & Conditions |

### Angular.js Routing

All client-side routing is configured in `js/app.js`:

```javascript
$routeProvider
  .when("/",                         { templateUrl: "home.php" })
  .when("/about.php",                { templateUrl: "about.php" })
  .when("/services.php",             { templateUrl: "services.php" })
  .when("/portfolio.php",            { templateUrl: "portfolio.php" })
  .when("/blog.php",                 { templateUrl: "blog.php" })
  .when("/blog-detail.php/:topicId", { templateUrl: "blog-detail.php",
                                       controller: "BlogDetailController" })
  .when("/contact.php",              { templateUrl: "contact.php" })
  // … service detail routes …
  .otherwise({ redirectTo: "/" });
```

---

## Backend & API

### Contact Form Endpoint

| | |
|-|-|
| **URL** | `POST /backend/contact-form.php` |
| **Content-Type** | `application/x-www-form-urlencoded` |

**Parameters**

| Field | Required | Description |
|-------|----------|-------------|
| `firstname` | ✅ | Sender's first name |
| `lastname` | ❌ | Sender's last name |
| `email` | ✅ | Sender's email address (validated with `filter_var`) |
| `inquery` | ❌ | Selected inquiry topic |
| `subject` | ✅ | Message body |

**Responses**

| HTTP Status | Message |
|-------------|---------|
| 200 | `Your message has been sent successfully. We will get back to you soon!` |
| 400 | `Please fill in all required fields.` |
| 405 | `Method not allowed.` |
| 500 | `Failed to send your message. Please try again later.` |

**Security measures in the back-end:**
- All input is sanitised with `htmlspecialchars()` and `filter_var()`
- `.env` is blocked from HTTP access via `.htaccess` and `router.php`
- No database access eliminates SQL injection risk

### Router (`router.php`)

Used only when the PHP built-in server runs the app (Render deployment):

- Blocks direct access to `.env`
- Serves static files (CSS, JS, images) directly
- Routes `/` → `frontend/index.php`
- Maps bare PHP filenames to `frontend/<name>.php`
- Falls back to the SPA shell for any unmatched path
- Validates filenames with an allow-list regex (prevents path traversal)

---

## Environment Variables

Copy `.env.example` to `.env` and fill in your values:

```bash
cp .env.example .env
```

| Variable | Required | Description |
|----------|----------|-------------|
| `MAILGUN_API_KEY` | ✅ | Your Mailgun private API key |
| `MAILGUN_DOMAIN` | ✅ | The sending domain registered in Mailgun (e.g. `sandboxXXX.mailgun.org`) |
| `MAIL_RECIPIENT` | ✅ | Email address that receives contact-form submissions (default: `info@heds.com`) |

> **Security note**: `.htaccess` and `router.php` both block direct HTTP access to `.env`. Never commit real credentials to version control.

---

## Getting Started (Local Development)

The fastest way to run the project locally is with Docker – no PHP or Composer installation required on your machine.

**Prerequisites**

| Tool | Minimum version |
|------|----------------|
| Docker | 20.10+ |
| Docker Compose | v2 |

```bash
# 1. Clone the repository
git clone https://github.com/Karugaba118/HEDS.git
cd HEDS

# 2. Create your environment file
cp .env.example .env
# Edit .env – add MAILGUN_API_KEY, MAILGUN_DOMAIN, MAIL_RECIPIENT

# 3. Build and start the container
docker compose up --build -d

# 4. Open the application
#    http://localhost:8080
```

Stop the application:

```bash
docker compose down
```

**Without Docker** (requires PHP 8.2+ and Composer on your machine):

```bash
cd backend
composer install

cd ..
php -S localhost:8000 router.php
# Open http://localhost:8000
```

---

## Deployment Options

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

> **Alternative**: click the deploy button at the top of this README (requires the repo to be public).

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
