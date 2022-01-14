import Vue from 'vue';
import App from './App.vue';

import FieldsList from './components/FieldsList.vue';
import FieldView from './components/FieldView.vue';
import FieldCreate from './components/FieldCreate.vue';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    redirect: "/list"
  },
  {
    path: "/list",
    name: "field_list",
    component: FieldsList
  },
  {
    path: "/view/:id",
    name: "field_view",
    component: FieldView
  },
  {
    path: "/create",
    name: "field_create",
    component: FieldCreate
  },
];

const router = new VueRouter ({
  mode: "history",
  routes
});

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
