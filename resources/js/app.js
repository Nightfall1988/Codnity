import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ArticleTable from './components/ArticleTable.vue';
app.component('article-table', ArticleTable);


app.mount('#list');
