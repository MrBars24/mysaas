# --- Base Stage ---
FROM node:20-alpine AS base
WORKDIR /app
COPY package*.json ./

# --- Stage 1: Development (Used by Docker Compose for local dev) ---
FROM base AS development
RUN npm install
COPY . .
EXPOSE 3000
CMD ["npm", "run", "dev"]

# --- Stage 2: Build Stage (Generates Pure Static SPA Assets) ---
FROM base AS build
RUN npm ci
COPY . .
# Generates pure static SPA distribution assets (.output/public)
RUN npm run generate

# --- Stage 3: Production Nginx Server (AWS ECS/Fargate Deployment) ---
FROM nginx:alpine AS production
COPY --from=build /app/.output/public /usr/share/nginx/html
COPY docker/nginx/spa.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]