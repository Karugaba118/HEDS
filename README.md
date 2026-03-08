# HEDS – High End Digital Services

A PHP + Angular.js portfolio website for a digital-agency.  
The application is served by Apache and uses [Mailgun](https://www.mailgun.com/) for the contact form.

---

## Requirements

| Tool | Minimum version |
|------|----------------|
| Docker | 20.10+ |
| Docker Compose | v2 |

> **No PHP / Composer installation on the host is required** – everything runs inside the container.

---

## Quick start (Docker)

```bash
# 1. Clone the repository
git clone https://github.com/Karugaba118/HEDS.git
cd HEDS

# 2. Create your environment file
cp .env.example .env
# Edit .env and fill in your MAILGUN_API_KEY, MAILGUN_DOMAIN, and MAIL_RECIPIENT

# 3. Build and start the container
docker compose up --build -d

# 4. Open the application
#    http://localhost:8080
```

Stop the application:

```bash
docker compose down
```

---

## Environment variables

Copy `.env.example` to `.env` and set the values:

| Variable | Description |
|----------|-------------|
| `MAILGUN_API_KEY` | Your Mailgun private API key |
| `MAILGUN_DOMAIN` | The sending domain registered in Mailgun |
| `MAIL_RECIPIENT` | Email address that receives contact-form messages (default: `info@heds.com`) |

---

## Project structure

```
HEDS/
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

---

## Deployment to a VPS / cloud VM

1. Install Docker and Docker Compose on the server.
2. Clone the repository and follow the **Quick start** steps above.
3. To expose the site on port 80, change the port mapping in `docker-compose.yml`:

   ```yaml
   ports:
     - "80:80"
   ```

4. Configure a reverse proxy (e.g. Nginx, Caddy) in front of the container if you need HTTPS / multiple virtual hosts.
