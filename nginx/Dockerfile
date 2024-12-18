# Stage 1: Install dependencies
FROM nginx:latest AS builder

COPY resolv.conf /etc/resolv.conf

RUN apt-get update && \
    apt-get install -y --no-install-recommends iputils-ping dnsutils telnet netcat-openbsd && \
    rm -rf /var/lib/apt/lists/*

# Stage 2: Copy only necessary files into a fresh Nginx image
FROM nginx:latest

COPY --from=builder /usr/bin/ping /usr/bin/ping
COPY --from=builder /usr/bin/nslookup /usr/bin/nslookup
COPY --from=builder /usr/bin/telnet /usr/bin/telnet
COPY --from=builder /bin/nc /bin/nc

COPY nginx.conf /etc/nginx/nginx.conf