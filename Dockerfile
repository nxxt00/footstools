FROM nginx:1.27-alpine

ARG SITE_VERSION=1.0

LABEL org.opencontainers.image.title="Goldmann Footstools Homepage"
LABEL org.opencontainers.image.description="Static homepage served by Nginx"
LABEL org.opencontainers.image.version="${SITE_VERSION}"
LABEL org.opencontainers.image.source="https://github.com/nxxt00/footstools"

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY *.html /usr/share/nginx/html/
COPY VERSION /usr/share/nginx/html/VERSION
COPY grafik /usr/share/nginx/html/grafik
COPY images /usr/share/nginx/html/images
COPY include /usr/share/nginx/html/include
COPY jagd /usr/share/nginx/html/jagd
COPY stoffe /usr/share/nginx/html/stoffe

EXPOSE 80
