<template>
  <div>
    <h2>Articles</h2>
    <table>
      <thead>
        <tr>
          <th>Rank</th>
          <th>Title</th>
          <th>Link</th>
          <th>Points</th>
          <th>Author</th>
          <th>Date Created</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="article in articles" :key="article.id" :class="{ 'fade-out': article.deleted }">
          <td>{{ article.rank }}</td>
          <td>{{ article.title }}</td>
          <td><a :href="article.link" target="_blank">Link</a></td>
          <td>{{ article.points }}</td>
          <td>{{ article.author }}</td>
          <td>{{ article.date_created }}</td>
          <td>
            <button @click="deleteArticle(article.id, article)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- <ul class="pagination">
                        <li class="page-item" v-for="page in pagination.links" :key="page.label" :class="{ 'active': page.active }">
                            <a class="page-link" @click="fetchData(page.url)">{{ page.label }}</a>
                        </li>
                    </ul> -->
  </div>
</template>

<script>
export default {
  props: ['articles'],

  methods: {
    deleteArticle(articleId, article) {
      axios.post(`/delete-articles/${articleId}`)
        .then(response => {
          if (response.data == 1) {
            article.deleted = true;

            setTimeout(() => {
              const index = this.articles.findIndex(a => a.id === articleId);
              if (index !== -1) {
                this.articles.splice(index, 1);
              }
            }, 500);

            console.log('Article deleted successfully');
          }
        })
        .catch(error => {
          console.error('Error deleting article:', error);
        });
    },
    fetchData(url) {
        axios.post(url)
            .then(response => {
                this.currencyRates = response.data.data;
                this.pagination = response.data;

                let rates = [];

                for (let i = 0; i < this.currencyRates.length; i++) {
                    rates.push(this.currencyRates[i].rate);
                }

                this.minRate = Math.min(...rates);
                this.maxRate = Math.max(...rates);
                this.avgRate = this.getAverage(this.currencyRates);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        },
  }
}
</script>

<style>
.fade-out {
  transition: opacity 0.5s ease-out;
  opacity: 0;
}
</style>
