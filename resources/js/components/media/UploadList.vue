<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="(item, index) in items" :key="index">
            <!-- <img src="..." class="img-thumbnail" alt="..." /> -->
            <p>File Title : {{item.name}} </p>
            <p>File Size : {{filesize(item.size)}} </p>
            <p>File Type : {{item.type}} </p>
            <p>File preview_thumbnail : {{item.preview_thumbnail}} </p>
            <p>File file_name : {{item.file_name}} </p>
            <!-- <p>File Type : {{item.type}} </p> -->
        </li>
    </ul>
</template>

<script>
export default {
    name: 'UploadList',
    props: ['items'],

    computed: {
        files() {
            return this.items.reverse()
        }
    },

    methods: {
    checkProgress(attachment) {
      this.tableKey += 1
      return attachment.progress === null ? false : true
    },
    isCanceledOrError(file) {
      return file.status === 'canceled' || file.status === 'error'
    },
    isUploading(file) {
      return (
        file.status === 'canceled' ||
        file.status === 'error' ||
        file.status === 'success'
      )
    },
    removeTmpFile(file) {
      this.$emit('tmp-file-removed', file)
    },
    filesize(bytes, decimals = 1) {
      if (bytes === 0) return '0 Bytes'

      const k = 1000
      const dm = decimals < 0 ? 0 : decimals
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

      const i = Math.floor(Math.log(bytes) / Math.log(k))

      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i]
    }
  }
}
</script>

<style>

</style>
