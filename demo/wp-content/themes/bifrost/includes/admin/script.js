const bodyClasses = Array.from(document.querySelector('body').classList);
const portfolioItemSettings = document.querySelector(
  '.acf-tab-button[data-key=field_5b9fb41d81b3e]'
);
const portfolioItemGallery = document.querySelector(
  '.acf-tab-button[data-key=field_5b9fba326488b]'
);
const portfolioItemTabs = document.querySelector(
  '.acf-tab-button[data-key=field_5b9fbad6dc460]'
);
const productTab = document.querySelector(
  '.acf-tab-button[data-key=field_5b9fc8f5ae0d5]'
);
const postTab = document.querySelector(
  '.acf-tab-button[data-key=field_5ba524cf15054]'
);

// Portfolio Item Settings
if (
  bodyClasses.includes('post-type-portfolio') === false &&
  (portfolioItemSettings || portfolioItemGallery || portfolioItemTabs)
) {
  portfolioItemSettings.parentElement.style.display = 'none';
  portfolioItemGallery.parentElement.style.display = 'none';
  portfolioItemTabs.parentElement.style.display = 'none';
}

// Product Settings
if (bodyClasses.includes('post-type-product') === false && productTab) {
  productTab.parentElement.style.display = 'none';
}

// Post Settings
if (bodyClasses.includes('post-type-post') === false && postTab) {
  postTab.parentElement.style.display = 'none';
}
