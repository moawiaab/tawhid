<template>
    <div></div>
</template>

<script>
import ability from '../../services/ability';
export default {
    watch: {
        $route: {
            handler() {
                axios.get('abilities').then(response => {
                    ability.update([
                        { action: response.data.data, subject: 'all' }
                    ])
                })
            },
            immediate: true
        }
    }
}
</script>
