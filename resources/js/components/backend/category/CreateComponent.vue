<template>
  <div>
    <div class="card">
      <div class="card-header text-white bg-success">
        <h5 class="m-0">
          <i class="fa fa-plus-circle fa-fw"></i> Create Category
        </h5>
      </div>
      <div class="card-body">
        <form @submit.prevent="createCategory">
          <div class="error" v-if="errors.length">
            <span v-for="(err, index) in errors" :key="index">{{ err }}</span>
            <hr />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" v-model="post.title" />
            <!-- @error('title')
            <div class="invalid-feedback">{{ $message }}</div>@enderror-->
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea class="form-control" rows="5" name="description" v-model="post.description"></textarea>
            <!-- @error('description')
            <div class="invalid-feedback">{{ $message }}</div>@enderror-->
          </div>
          <!-- <div class="form-group">
            <div class="custom-control custom-radio custom-control-inline">
              <input
                type="radio"
                id="customRadioInline2"
                name="status"
                class="custom-control-input"
                value="1"
                checked
              />
              <label class="custom-control-label" for="customRadioInline2">Active</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input
                type="radio"
                id="customRadioInline1"
                name="status"
                class="custom-control-input"
                value="0"
              />
              <label class="custom-control-label" for="customRadioInline1">Unactive</label>
            </div>
          </div>-->
          <a class="btn btn-secondary" href>Cancel</a>
          <button class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      post: {
        title: null,
        description: null
      },
      errors: []
    };
  },

  methods: {
    createCategory() {

      let uri = "/category/create";

      // if (this.post.title && this.post.description) {
      //   return true;
      // }

      // this.errors = [];

      // if (!this.post.title) {
      //   this.errors.push("Name required.");
      // }
      // if (!this.post.description) {
      //   this.errors.push("Age required.");
      // }

      // console.log(this.errors);

      axios
        .post(uri, this.post)
        .then(response => {
          this.$router.push({ name: "category" });
        });
    }
  }
}
</script>