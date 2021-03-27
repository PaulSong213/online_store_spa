
import {createApp} from 'vue';

//component
import FilterTag from './components/filter-tag.vue';
import CircleLoader from './components/circle-loader.vue';
import ReachedEndMessage from './components/reached-end-message.vue';
import FeaturedProductCard from './components/featured-product-card.vue';
import DiscoverProductCard from './components/discover-product-card.vue';
import DiscoverProductOnTab from './components/discover-product-on-tab.vue';

//views
import App from './App.vue';
import ProductDiscover from './views/product-discover.vue';
import ProductIndex from './views/product-index.vue';
import NotFound from './views/not-found.vue'; //empty template for views that do not need vue

const routes = {
  '/products': ProductIndex,
  '/products/index': ProductIndex,
  '/products/discover': ProductDiscover,
  '/': ProductDiscover,
  'notFound': NotFound,
}


const app = createApp(App)
		.component('reached-end-message', ReachedEndMessage)
		.component('circle-loader', CircleLoader)
		.component('filter-tag', FilterTag)
		.component('featured-product-card', FeaturedProductCard)
		.component('discover-product-card', DiscoverProductCard)
		.component('discover-product-on-tab', DiscoverProductOnTab)
		.component('current-route', routes[window.location.pathname] || routes['notFound'])
		.mount("#app");