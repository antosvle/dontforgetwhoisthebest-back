const express = require('express');
const browserObject = require('./puppeteer/browser');
const scrapeFighters = require('./puppeteer/pageController');


// Express conf
const PORT = 80;
const HOST = '0.0.0.0';
const app = express();


// HTTP server
app.get('/', (req, res) => res.end("Welcome on DFWITB's web scraper !"))

app.get('/scraper/fighters', (req, res) => {

  const browserInstance = browserObject.startBrowser();
  scrapeFighters(browserInstance)
    .then((data) => res.json(data))
    .catch((err) => res.status(500).end())
});

app.listen(PORT, HOST);
