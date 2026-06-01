# Docker Deployment

This homepage is a static site, so the Docker image only needs Nginx.

## Build Locally

```bash
docker build -t footstools-homepage:latest .
```

## Run Locally

```bash
docker compose up -d --build
```

Open `http://localhost:8080`.

## Run On A VPS

Copy the repository to the server, then run:

```bash
docker compose up -d --build
```

For direct public hosting on the VPS, change the port mapping in `compose.yaml`
from `8080:80` to `80:80`, or keep `8080:80` behind a reverse proxy such as
Caddy or Nginx.

## Update

```bash
git pull
docker compose up -d --build
```
