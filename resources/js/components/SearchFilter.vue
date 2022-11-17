<template>
    <div class="w-50" :class="{
        'has-items': query.s,
        'is-focused': focus
    }">
        <div class="input-group">
            <v-text-field type="search" name="search" placeholder="ابحث هنا" :value="query.s"
                @input="debounceSearch($event.target.value)" @focus="focus = true" @blur="focus = false"
                variant="underlined">
                <template v-slot:append>
                    <v-icon icon="mdi-close" v-if="query.s.length !== 0" @click="query.s = ''" />
                </template>
            </v-text-field>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SearchFilter',
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
