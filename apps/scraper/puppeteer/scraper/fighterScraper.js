const fighterScraper = {

    url: 'https://www.smashbros.com/en_US/fighter/index.html',
    async scraper(browser){


        // Create fighter list page instance
        const page = await browser.newPage();
        await page.goto(this.url);


        // Get fighters data from list page
        await page.waitForSelector('.fighter-list');
        let fighters_data = await page.$$eval('.fighter-list__item', (fighter_item) => {
          
            // For each fighter, we extract its name, image, icon and personal page url.
            fighter_item = fighter_item.map((child_el) => {
                const name = child_el.querySelector('.fighter-list__name-main').textContent
                const profile_url = child_el.querySelector('.fighter-list__img').style.backgroundImage.split('"')[1]
                const icon_root = child_el.querySelector('.fighter-list__mark use')
                const page = child_el.querySelector('.fighter-list__btn').href

                if(name !== '') return {
                    'name': name,
                    'img': "https://www.smashbros.com" + profile_url,
                    'icon': "https://www.smashbros.com" + icon_root.getAttributeNS('http://www.w3.org/1999/xlink', 'href'),
                    'page': page,
                }
            })
            return fighter_item
        })
        page.close()


        // Clean fighters object (we remove trash object )
        fighters_data = fighters_data.filter((el) => el !== null)


        // For each fighter, we need to query its personal page to get more data
       /* for(index in fighters_data){
            // Generate a new page for the current fighter with its personal url
            const fighter_page = await browser.newPage();
            await fighter_page.goto(fighters_data[index].page);

            // Get some other data from its page
            fighters_data[index].img_large_url = await fighter_page.$eval('.fighter-main__item img', (el) => el.src)
            fighters_data[index].background_url = "https://www.smashbros.com" + await fighter_page.$eval('.fighter-bg__img', (el) => el.style.backgroundImage.split('"')[1])
            await fighter_page.close();
            console.log(fighters_data[index])
        }*/

        return fighters_data
    }
}


module.exports = fighterScraper;