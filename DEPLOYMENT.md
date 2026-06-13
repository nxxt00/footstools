# Docker Deployment

Version: 1.0

This homepage is a static site served by Nginx. The VPS does not need to build
the site or clone the repository manually. GitHub Actions builds the Docker
image and publishes it to GitHub Container Registry.

## Image

```text
ghcr.io/nxxt00/footstools:latest
ghcr.io/nxxt00/footstools:1.0
```

Use `latest` for automatic Watchtower updates. Use `1.0` only if you want to pin
the VPS to this exact release line.

## Portainer Stack

Use the included `docker-compose.yml` or `compose.yaml` as a Portainer stack:

```yaml
services:
  footstools-homepage:
    image: ghcr.io/nxxt00/footstools:latest
    container_name: footstools-homepage
    restart: unless-stopped
    # Internal container port only. Do not publish host port 80;
    # Nginx Proxy Manager already owns host ports 80/443.
    expose:
      - "80"
    labels:
      - "com.centurylinklabs.watchtower.enable=true"
    networks:
      - nginx_default

networks:
  nginx_default:
    external: true
```

The `nginx_default` network must be the same Docker network used by Nginx Proxy
Manager. Check the network name on the VPS with:

```bash
docker network ls
```

If your Nginx Proxy Manager network has a different name, update `compose.yaml`.
If you use `docker-compose.yml` instead, update the same network name there too.

Do not add a `ports:` mapping such as `80:80` or `8080:80` for this service.
Nginx Proxy Manager is the only container that should publish host ports 80 and
443. The homepage only needs to be reachable from NPM over the shared Docker
network.

## Nginx Proxy Manager

Create a Proxy Host:

```text
Domain Names: your-domain.de
Scheme: http
Forward Hostname / IP: footstools-homepage
Forward Port: 80
```

Enable:

```text
Block Common Exploits
Websockets Support: off
SSL Certificate: Let's Encrypt
Force SSL
HTTP/2 Support
```

## Watchtower

Your Watchtower setup uses:

```text
WATCHTOWER_LABEL_ENABLE=true
```

The homepage container includes this label, so Watchtower will update it:

```text
com.centurylinklabs.watchtower.enable=true
```

With `ghcr.io/nxxt00/footstools:latest`, Watchtower can pull a newer image when
GitHub Actions publishes one.

## Private GHCR Image

If the GitHub repository/package is private, the VPS must authenticate to GHCR.
Do not put the token into `docker-compose.yml`.

Create a GitHub Personal Access Token with package read access:

```text
read:packages
```

For a classic token, private repositories/packages may also require:

```text
repo
```

Then log in to GHCR on the VPS once:

```bash
echo YOUR_GITHUB_PAT | docker login ghcr.io -u YOUR_GITHUB_USERNAME --password-stdin
```

Test the pull:

```bash
docker pull ghcr.io/nxxt00/footstools:latest
```

After that, Docker Compose can pull the private image:

```bash
docker compose pull
docker compose up -d
```

### Portainer Registry Setup

In Portainer, add a registry:

```text
Registries > Add registry
Type: Custom registry
Name: GitHub Container Registry
Registry URL: ghcr.io
Username: YOUR_GITHUB_USERNAME
Password: YOUR_GITHUB_PAT
```

When deploying the stack, make sure Portainer uses those registry credentials.

### Watchtower Auth For Private Images

Watchtower also needs access to the GHCR credentials when it checks for updates.
If you logged in as root on the VPS, add this volume to the Watchtower service:

```yaml
volumes:
  - /var/run/docker.sock:/var/run/docker.sock
  - /root/.docker/config.json:/config.json:ro
```

If you logged in as another Linux user, mount that user's Docker config instead,
for example:

```yaml
volumes:
  - /var/run/docker.sock:/var/run/docker.sock
  - /home/ubuntu/.docker/config.json:/config.json:ro
```

## Release Flow

1. Commit and push homepage changes to `master`.
2. GitHub Actions builds and publishes the image.
3. Watchtower detects the new `latest` image.
4. Watchtower recreates the `footstools-homepage` container.

For a manual update in Portainer, pull/redeploy the stack after GitHub Actions
finishes.
