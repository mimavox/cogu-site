Marble theme for Bludit
========================

Ported Marble template (original designed by [FREEHTML5.co](https://freehtml5.co/)) to [Bludit](https://www.bludit.com/).

## Differences from the original theme

- No portforio page.
- No recent blog on home page.

## How to add a top page

1. Add a static page.
2. Open the options for that page and set "top" as the template on the Advanced tab.
3. Go to Settings > Advanced. Set the static page you created to the homepage of the predefined page.

### How to set the hero image in a top page

1. Add a static page with the slug name "service".
2. Create a child page on that "service" static page with a cover image and description.

static pages ex)
```
service
├ service1 (with cover image and description)
├ service2 (with cover image and description)
└ service3 (with cover image and description)
```

### How to set icons on service child pages

1. Go to Custom Fields in Settings. Add the json below.

```json
{
  "icon": {
    "type": "string",
    "placeholder": "add a icomoon icon name"
  }
}
```

2. Go to the child page of the service static page.
3. Open Options and set icomoon font name to Custom. icomoon font name can be found in <https://icomoon.io/#preview-free>.

## How to add a contact page

1. Add a static page with the slug name "contact".

A link to the contact page is added to the footer. The contact page is supported by [contact3](https://plugins.bludit.com/plugin/contact3).

## Compatible

- Bludit v3.x

## Author

- Jun Nogata <nogajun+bludit@gmail.com>

<a href="https://www.buymeacoffee.com/nogajun" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/yellow_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>

## Original credits

- Title: Marble - Fully Responsive Free HTML5 template
  - Marble Free HTML5 Bootstrap Template for Portfolio or Multi Purpose Websites: <https://freehtml5.co/marble-free-html5-bootstrap-template-for-portfolio-or-multi-purpose-websites/>
- Original designed by [FREEHTML5.co](http://freehtml5.co/)
- License
  - [Creative Commons Attribution 3.0 Unported (CC BY 3.0) ](https://creativecommons.org/licenses/by/3.0/)
  - Frequently Asked Questions - FreeHTML5.co: https://freehtml5.co/faq/#faq-license

## Screenshot

- N/A

## Live Demo

- N/A
