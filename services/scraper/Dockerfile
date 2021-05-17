FROM buildkite/puppeteer:latest

WORKDIR /app

COPY ./apps/scraper/package*.json ./
RUN npm install

COPY ./apps/scraper .

CMD [ "node", "index.js" ]
EXPOSE 80
