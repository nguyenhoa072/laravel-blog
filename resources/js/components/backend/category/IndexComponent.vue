<template>
  <div>
    <router-link to="category/create" class="nav-link">Create Post</router-link>
    <div class="card mt-4">
      <div class="card-header">
        <h5 class="m-0">Category Product</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th width="1%">#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th width="1%">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in items" :key="item.id">
                <td>{{ item.id }}</td>
                <td>{{ item.title }}</td>
                <td>{{ item.description }}</td>
                <td></td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <router-link
                      :to="{name: 'edit', params: { id: item.id }}"
                      class="btn btn-outline-warning"
                    >Edit</router-link>
                    <button
                      class="btn btn-outline-danger"
                      @click="deletePost(item.id, index)"
                    >Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
    };
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      var uri = "/category/list";
      axios.get(uri).then(response => {
        this.items = response.data;
      });
    },

    deletePost(id, index) {
      let uri = `/category/delete/${id}`;
      axios
        .delete(uri)
        .then(response => {
          this.items.splice(index, 1);
          // this.$delete(this.items, index);
        })
    }
  }
};
</script>
