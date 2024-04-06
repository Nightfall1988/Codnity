<template>
  <div>
      <div id="table-container">
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
      <br>
      <br>
      </div>
          <div id="pagination">
            <nav aria-label="navigation">
              <ul class="pagination">
                  <li class="page-item" v-for="page in pagination.links" :key="page.label" :class="{ 'active': page.active }">
                      <a class="page-link" @click="getArticles(page.url)">{{ page.label }}</a>
                  </li>
              </ul>
            </nav>
        </div>
  </div>
</template>

<script>
export default {
    data() {
      return {
        articles: [],
        pagination: {}
      };
    },
    mounted() {
    this.getArticles('/articles?page=1');
  },
  methods: {
    getArticles(url) {
      axios.get(url)
        .then(response => {

          this.articles = response.data.data;
          this.pagination = response.data;
        })
        .catch(error => {
          console.error('Error fetching articles:', error);
        });
    },

    deleteArticle(id, article) {
      axios.post('/delete-article/' + id)
        .then(response => {
          if (response.data == 1) {
          article.deleted = true;
          setTimeout(() => {
            const index = this.articles.findIndex(a => a.id === id);
            if (index !== -1) {
              this.articles.splice(index, 1);
            }
          }, 500);
        } 
      }) 
        .catch(error => {
          console.error('Error fetching articles:', error);
        });
      }
    },
  }
</script>

<style>
.fade-out {
  transition: opacity 0.5s ease-out, transform 0.5s ease-out;
  opacity: 0;
  transform: translateY(-100%);
}
</style>
