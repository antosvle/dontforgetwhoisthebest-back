const pageScraper = require('./scraper/fighterScraper');


async function scrapeFighters(browserInstance){
    let browser;
    try{
        browser = await browserInstance;
        return pageScraper.scraper(browser);

    }
    catch(err){
        console.log("Could not resolve the browser instance => ", err);
    }
}


module.exports = (browserInstance) => scrapeFighters(browserInstance)
