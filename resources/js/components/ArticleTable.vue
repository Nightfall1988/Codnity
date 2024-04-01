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
            <tr v-for="article in articles" :key="article.id">
              <td>{{ article.rank }}</td>
              <td>{{ article.title }}</td>
              <td><a :href="article.link">Link</a></td>
              <td>{{ article.points }}</td>
              <td>{{ article.author }}</td>
              <td>{{ article.date_created }}</td>
              <td><button>Delete</button></td>
            </tr>
        </tbody>
        </table>
        <div>
  </div>
    </div>
</template>
  
  <script>
  export default {
    props: ['articles'],
    // data() {
    //   return {
    //     articles: []
    //   };
    // },

    mounted() {
        console.dir(this.articles)
    },
    methods: {
      fetchArticles() {
        // Make an API call to fetch articles data
        // For example, using axios or fetch
        // Replace this with your actual API endpoint
        axios.get('/api/articles')
          .then(response => {
            this.articles = response.data;
          })
          .catch(error => {
            console.error('Error fetching articles:', error);
          });
      },
    }
}

  </script>
  