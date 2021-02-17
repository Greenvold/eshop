import Vue from "vue";
import Axios from "axios";
import apiConfig from "../config";
import rules from "../validation-rules";

Vue.prototype.$storage = `${process.env.storageUrl}/`;

Vue.prototype.$inProduction = process.env.isInProduction

Vue.prototype.$api = `${process.env.apiUrl}`;
Vue.config.ignoredElements = ["video-js"];

Vue.config.productionTip = false;
Vue.prototype.$http = Axios;

Vue.prototype.$config = apiConfig;
Vue.prototype.$rules = rules;
