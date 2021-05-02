FROM php:7.2-fpm-alpine
FROM node:12.18-alpine
RUN docker-php-ext-install pdo pdo_mysql
ENV NODE_ENV=production
WORKDIR /usr/src/app
COPY ["package.json", "package-lock.json*", "npm-shrinkwrap.json*", "./"]
RUN npm install --production --silent && mv node_modules ../
COPY . .
EXPOSE 8000
CMD ["npm", "start"]
