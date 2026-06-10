FROM nginx:1.27-alpine

COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY *.html /usr/share/nginx/html/
COPY city /usr/share/nginx/html/city
COPY country /usr/share/nginx/html/country
COPY grafik /usr/share/nginx/html/grafik
COPY images /usr/share/nginx/html/images
COPY include /usr/share/nginx/html/include
COPY jagd /usr/share/nginx/html/jagd
COPY kamin /usr/share/nginx/html/kamin
COPY signature /usr/share/nginx/html/signature
COPY stoffe /usr/share/nginx/html/stoffe

EXPOSE 80
