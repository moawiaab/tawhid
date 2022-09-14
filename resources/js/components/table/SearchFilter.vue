<template>
    <div
      class="form-group bmd-form-group"
      :class="{
        'has-items': query.s,
        'is-focused': focus
      }"
    >
      <div class="input-group">
        <input
          class="form-control"
          type="search"
          name="search"
          placeholder="ابحث هنا"
          :value="query.s"
          @input="debounceSearch($event.target.value)"
          @focus="focus = true"
          @blur="focus = false"
        />
        <div
          class="btn btn-just-icon btn-link text-dark d-inline-block input-group-append m-0"
          style="height: 36px;"
          v-if="query.s.length !== 0"
          @click="query.s = ''"
        >
          <i class="fa fa-times text-danger"></i>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      query: { type: Object, require: true }
    },
    data() {
      return {
        focus: false
      }
    },
    methods: {
      debounceSearch: _.debounce(function (value) {
        this.query.s = value
        this.query.offset = 0
      }, 300)
    }
  }
  </script>
